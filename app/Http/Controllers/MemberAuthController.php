<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MemberModel;
use App\Models\EmployeeModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MemberAuthController extends Controller
{
    // 🔧 ฟังก์ชันกลางสำหรับอัปเดต Session
    private function updateMemberSession($member)
    {
        session([
            'mem_id'   => $member->mem_id,
            'mem_name' => $member->mem_name,
            'mem_pic'  => $member->mem_pic ?? 'default.png',
        ]);
    }

    // 📌 แสดงฟอร์มสมัครสมาชิก
    public function showRegisterForm()
    {
        return view('member.register');
    }

    // 📌 สมัครสมาชิก
    public function register(Request $request)
    {
        $request->validate([
            'mem_name'      => 'required|string|max:100',
            'mem_username'  => 'required|string|max:100|unique:tbl_member',
            'mem_email'     => 'required|email|max:100|unique:tbl_member',
            'mem_phone'     => 'nullable|string|max:20',
            'mem_gender'    => 'nullable|string|max:10',
            'mem_dob'       => 'nullable|date',
            'mem_password'  => 'required|string|min:6|confirmed',
            'mem_pic'       => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // ✅ default avatar = default.png
        $filename = 'default.png';

        // 📂 ถ้ามีการอัปโหลดรูป → เก็บไฟล์ใน storage/app/public/uploads/member
        if ($request->hasFile('mem_pic')) {
            $path = $request->file('mem_pic')->store('uploads/member', 'public'); 
            $filename = $path; // เช่น uploads/member/xxxx.png
        }

        // ✅ บันทึกสมาชิกใหม่
        $member = MemberModel::create([
            'mem_name'     => $request->mem_name,
            'mem_username' => $request->mem_username,
            'mem_email'    => $request->mem_email,
            'mem_phone'    => $request->mem_phone,
            'mem_gender'   => $request->mem_gender,
            'mem_dob'      => $request->mem_dob,
            'mem_password' => Hash::make($request->mem_password),
            'mem_pic'      => $filename, // ✅ เก็บ path เช่น uploads/member/xxxx.png
            'point'        => 100,
        ]);

        // 🔑 ล็อกอินอัตโนมัติ
        Auth::guard('member')->login($member);

        // ✅ อัปเดต Session
        $this->updateMemberSession($member);

        return redirect()->route('member.home')->with('success', 'สมัครสมาชิกสำเร็จแล้ว! 🎉');
    }

    // 📌 แสดงฟอร์มล็อกอิน
    public function showLoginForm()
    {
        return view('member.login');
    }

    // 📌 ล็อกอิน
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string|max:100',
            'password' => 'required|string|min:3',
        ]);

        $loginInput = $request->login;
        $password = $request->password;

        // 📌 ตรวจสอบว่า login เป็น email หรือ username
        $loginTypeMember = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'mem_email' : 'mem_username';
        $loginTypeEmployee = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'emp_email' : 'emp_username';

        // 🔎 ลองเช็คในตาราง Member
        $member = \App\Models\MemberModel::where($loginTypeMember, $loginInput)->first();

        if ($member && Hash::check($password, $member->mem_password)) {
            Auth::guard('member')->login($member);

            session([
                'mem_id'   => $member->mem_id,
                'mem_name' => $member->mem_name,
                'mem_pic'  => $member->mem_pic,
                'role'     => 'member',
            ]);

            return redirect()->route('member.home');
        }

        // 🔎 ถ้าไม่เจอ → เช็คในตาราง Employee
        $employee = \App\Models\EmployeeModel::where($loginTypeEmployee, $loginInput)->first();

        if ($employee && Hash::check($password, $employee->emp_password)) {
            Auth::guard('admin')->login($employee);

            session([
                'emp_id'       => $employee->emp_id,
                'emp_name'     => $employee->emp_name,
                'emp_username' => $employee->emp_username,
                'emp_email'    => $employee->emp_email,
                'emp_pic'      => $employee->emp_pic,
                'role'         => $employee->role, // admin หรือ staff
            ]);

            return redirect('/dashboard');
        } else {
            // ❌ ถ้าไม่เจอทั้งสอง
            return back()->withErrors([
                'login' => 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง',
            ]);
        }
    }

    public function logout(Request $request)
    {
        // ถ้า login มาจาก guard member
        if (Auth::guard('member')->check()) {
            Auth::guard('member')->logout();
            $request->session()->forget(['mem_id', 'mem_name', 'mem_pic', 'role']);
        }

        // ถ้า login มาจาก guard admin (admin/staff)
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            $request->session()->forget(['emp_id', 'emp_name', 'emp_username', 'emp_email', 'emp_pic', 'role']);
        }

        // ✅ clear session ทั้งหมดเพื่อความชัวร์
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'ออกจากระบบเรียบร้อยแล้ว');
    }
}
