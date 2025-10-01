<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert; //sweet alert
use Illuminate\Support\Facades\Hash;

class MemberPasswordController extends Controller
{
    // 📌 แสดงฟอร์มเปลี่ยนรหัสผ่าน
    public function edit()
    {
        return view('member.password');
    }

    // 📌 อัปเดตรหัสผ่าน
    public function update(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|string|min:6|confirmed',
        ]);

        $member = Auth::guard('member')->user();

        // ตรวจสอบรหัสผ่านปัจจุบัน
        if (!Hash::check($request->current_password, $member->mem_password)) {
            return back()->withErrors(['current_password' => 'รหัสผ่านปัจจุบันไม่ถูกต้อง ❌']);
        }

        // อัปเดตรหัสผ่านใหม่
        $member->mem_password = Hash::make($request->new_password);
        $member->save();

        Alert::success('Update Successfully');
        return redirect('/member/memberinfo');
    }
}
