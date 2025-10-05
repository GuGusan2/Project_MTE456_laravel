<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MemberModel;
use App\Models\EmployeeModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator; //form validation
use Illuminate\Support\Facades\Storage;


class MemberAuthController extends Controller
{
    // 🔧 ฟังก์ชันกลางสำหรับอัปเดต Session
    private function updateMemberSession($member)
    {
        session([
            'mem_id'   => $member->mem_id,
            'mem_name' => $member->mem_name,
            'mem_pic'  => $member->mem_pic,
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
        //msg
        $messages = [
            'mem_name.required' => 'กรุณากรอกข้อมูล',
            'mem_name.min' => 'ต้องมีอย่างน้อย :min ตัวอักษร',

            'mem_username.required' => 'กรุณากรอกข้อมูล',
            'mem_username.unique' => 'ข้อมูลซ้ำ',
            'mem_username.min' => 'ต้องมีอย่างน้อย :min ตัวอักษร',

            'mem_email.required' => 'กรุณากรอกข้อมูล',
            'mem_email.email' => 'รูปแบบอีเมลไม่ถูกต้อง',
            'mem_email.unique' => 'Email ซ้ำ เพิ่มใหม่อีกครั้ง  !!',

            'mem_password.required' => 'กรุณากรอกข้อมูล',
            'mem_password.min' => 'กรอกข้อมูลขั้นต่ำ :min ตัว',
            'mem_password.confirmed' => 'password not match!!',

            'mem_password_confirmation.required' => 'กรุณากรอกรหัสผ่าน',

            'mem_password_confirmation.min' => 'รหัสผ่านต้องไม่ต่ำกว่า :min ตัว',

            'mem_phone.required' => 'กรุณากรอกข้อมูล',
            'mem_phone.min' => 'ต้องมีอย่างน้อย :min',
            'mem_phone.max' => 'ห้ามเกิน :max',

            'mem_gender.required' => 'กรุณาเลือก',
            'mem_dob.required' => 'กรุณาเลือก',

            'mem_pic.mimes' => 'รองรับ jpeg, png, jpg เท่านั้น !!',
            'mem_pic.max' => 'ขนาดไฟล์ไม่เกิน',
        ];

        $validator = Validator::make($request->all(), [
            'mem_name'      => 'required|string|max:100|min:3',
            'mem_username'  => 'required|string|max:100|min:2|unique:tbl_member',
            'mem_email'     => 'required|email|max:100|unique:tbl_member',
            'mem_phone'     => 'string|max:10|min:10',
            'mem_gender'    => 'nullable|string|max:10',
            'mem_dob'       => 'nullable|date',
            'mem_password'  => 'required|string|min:6|confirmed',
            'mem_password_confirmation'  => 'required|string|min:6',
            'mem_pic'       => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ], $messages);

        //check 
        if ($validator->fails()) {
            return redirect('member/register/')
                ->withErrors($validator)
                ->withInput();
        }


        
        try {
            $imagePath = null;
            if ($request->hasFile('mem_pic')) {
                $imagePath = $request->file('mem_pic')->store('uploads/member', 'public');

                // ✅ บันทึกสมาชิกใหม่
            $member = MemberModel::create([
                'mem_name'     => $request->mem_name,
                'mem_username' => $request->mem_username,
                'mem_email'    => $request->mem_email,
                'mem_phone'    => $request->mem_phone,
                'mem_gender'   => $request->mem_gender,
                'mem_dob'      => $request->mem_dob,
                'mem_password' => Hash::make($request->mem_password),
                'mem_pic'      => $imagePath,
                'point'        => 100,
            ]);

            // 🔑 ล็อกอินอัตโนมัติ
            Auth::guard('member')->login($member);

            // ✅ อัปเดต Session
            $this->updateMemberSession($member);

            // ✅ ส่ง flash session สำหรับ SweetAlert
            return redirect()->route('member.home')
                ->with('register_success', 'สมัครสมาชิกเรียบร้อยแล้ว 🎉');
            }

        } catch (\Exception $e) {  //error debug
            return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            // return view('errors.404');

            
        }
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
            'login'    => 'required|string|max:100',
            'password' => 'required|string|min:3',
        ]);

        $loginInput = $request->login;
        $password   = $request->password;

        // 📌 ตรวจสอบว่า login เป็น email หรือ username
        $loginTypeMember   = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'mem_email' : 'mem_username';
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

            // ✅ ส่ง flash session สำหรับ SweetAlert
            return redirect()->route('member.home')
                ->with('login_success', 'เข้าสู่ระบบเรียบร้อยแล้ว 🎉');
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

            return redirect('/dashboard')
                ->with('login_success', 'เข้าสู่ระบบเรียบร้อยแล้ว 🎉');
        }

        // ❌ ถ้าไม่เจอทั้งสอง
        return back()->withErrors([
            'login' => 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง',
        ]);
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
