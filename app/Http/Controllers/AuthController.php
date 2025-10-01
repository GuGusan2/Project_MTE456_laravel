<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\EmployeeModel;

class AuthController extends Controller
{
    // public function index()
    // {
    //     return view('auth.login');
    // }

    // 📌 แสดงฟอร์มล็อกอิน
    public function showLoginForm()
    {
        return view('member.login');
    }

    // public function login(Request $request)
    // {
    //     // Validate ข้อมูลที่ส่งมา
    //     $request->validate([
    //         'login' => 'required|string|max:100',
    //         'emp_password' => 'required|string|min:3',
    //     ], [
    //         'login.required' => 'กรุณากรอกข้อมูล',
    //         'emp_password.required' => 'กรุณากรอกข้อมูล',
    //         'emp_password.min' => 'กรอกข้อมูลขั้นต่ำ :min ตัว',
    //     ]);

    //     // ตรวจสอบว่า login เป็น email หรือ username
    //     $login_type = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'emp_email' : 'emp_username';

    //     // ดึง user จาก DB
    //     $user = EmployeeModel::where($login_type, $request->login)->first();

    //     if ($user && Hash::check($request->emp_password, $user->emp_password)) {
    //         // login สำเร็จ
    //         Auth::guard('admin')->login($user);

    //         // regenerate session
    //         $request->session()->regenerate();

    //         // เก็บค่า session
    //         session([
    //             'emp_name' => $user->emp_name,
    //             'emp_id' => $user->emp_id,
    //             'role' => $user->role,
    //             'emp_username' => $user->emp_username,
    //             'emp_email' => $user->emp_email,
    //             'emp_pic' => $user->emp_pic,
    //         ]);

    //         // Redirect ตาม role
    //         if ($user->role === 'admin') {
    //             return redirect('/dashboard');
    //         } elseif ($user->role === 'staff') {
    //             return redirect('/dashboard');
    //         } else {
    //             return redirect('/');
    //         }
    //     }

    //     // Login fail
    //     return back()->withErrors([
    //         'login' => 'ชื่อผู้ใช้หรืออีเมล หรือรหัสผ่านไม่ถูกต้อง',
    //     ])->withInput();
    // }


    // public function logout(Request $request)
    // {
    //     Auth::guard('admin')->logout();
    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return redirect('/');
    // }

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
