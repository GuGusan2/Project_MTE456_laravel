<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\EmployeeModel;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate ข้อมูลที่ส่งมา
        $request->validate([
            'login' => 'required|string|max:100',
            'emp_password' => 'required|string|min:3',
        ], [
            'login.required' => 'กรุณากรอกข้อมูล',
            'emp_password.required' => 'กรุณากรอกข้อมูล',
            'emp_password.min' => 'กรอกข้อมูลขั้นต่ำ :min ตัว',
        ]);

        // ตรวจสอบว่า login เป็น email หรือ username
        $login_type = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'emp_email' : 'emp_username';

        // ดึง user จาก DB
        $user = EmployeeModel::where($login_type, $request->login)->first();

        if ($user && Hash::check($request->emp_password, $user->emp_password)) {
            // login สำเร็จ
            Auth::guard('admin')->login($user);

            // regenerate session
            $request->session()->regenerate();

            // เก็บค่า session
            session([
                'emp_name' => $user->emp_name,
                'emp_id' => $user->emp_id,
                'role' => $user->role,
                'emp_username' => $user->emp_username,
                'emp_email' => $user->emp_email,
                'emp_pic' => $user->emp_pic,
            ]);

            // Redirect ตาม role
            if ($user->role === 'admin') {
                return redirect('/dashboard');
            } elseif ($user->role === 'staff') {
                return redirect('/dashboard');
            } else {
                return redirect('/');
            }
        }

        // Login fail
        return back()->withErrors([
            'login' => 'ชื่อผู้ใช้หรืออีเมล หรือรหัสผ่านไม่ถูกต้อง',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
