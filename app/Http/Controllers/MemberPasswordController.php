<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert; //sweet alert
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator; //form validation
use App\Models\MemberModel; //model

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

        //vali msg 
        $messages = [
            'current_password.required' => 'กรุณากรอกข้อมูล',

            'new_password.required' => 'กรุณากรอกข้อมูล',
            'new_password.min' => 'กรุณากรอกข้อมูลอย่างน้อย :min ตัว',
            'new_password.confirmed' => 'ยืนยันรหัสผ่านไม่ตรงกัน !!',

            'new_password_confirmation.required' => 'กรุณากรอกข้อมูล',
        ];

        //rule
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password'     => 'required|string|min:6|confirmed',
        ], $messages);

        //check 
        if ($validator->fails()) {
            return redirect('member/password')
                ->withErrors($validator)
                ->withInput();
        }

        try {

            $member = Auth::guard('member')->user();

            if (!Hash::check($request->current_password, $member->mem_password)) {
                return back()->withErrors(['current_password' => 'รหัสผ่านปัจจุบันไม่ถูกต้อง ❌']);
            }

            $member->mem_password = Hash::make($request->new_password);
            $member->save();
            // แสดง Alert ก่อน return
            Alert::success('เปลี่ยนรหัสผ่านเรียบร้อยแล้ว!!');
            return redirect('/member/memberinfo');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            //return view('errors.404');
        } //end

        // $message = [
        //     'current_password.required' => 'กรุณากรอกข้อมูล',
        //     'current_password.confirmed' => 'not match !!',

        //     'new_password.required' => 'กรุณากรอกข้อมูล',
        //     'new_password.min' => 'กรุณากรอกข้อมูลอย่างน้อย :min ตัว',
        // ];

        // $request->validate([
        //     'current_password' => 'required',
        //     'new_password'     => 'required|string|min:6|confirmed',
        // ], $message);

        // $member = Auth::guard('member')->user();

        // // ตรวจสอบรหัสผ่านปัจจุบัน
        // if (!Hash::check($request->current_password, $member->mem_password)) {
        //     return back()->withErrors(['current_password' => 'รหัสผ่านปัจจุบันไม่ถูกต้อง ❌']);
        // }

        // // อัปเดตรหัสผ่านใหม่
        // $member->mem_password = Hash::make($request->new_password);
        // $member->save();

        Alert::success('เปลี่ยนรหัสผ่านเรียบร้อยแล้ว!!');
        return redirect('/member/memberinfo');
    }
}
