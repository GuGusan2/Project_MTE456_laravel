<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Favorite;
use App\Models\MemberModel;

class MemberProfileController extends Controller
{
    // 📌 หน้าโปรไฟล์
    public function profile()
    {
        $member = Auth::guard('member')->user();
        return view('member.profile', compact('member'));
    }

    // 📌 อัปเดตข้อมูลส่วนตัว
    public function updateProfile(Request $request)
    {
        /** @var \App\Models\MemberModel $member */
    $member = Auth::guard('member')->user();

    // ...
        $messages = [
            'mem_name.required' => 'กรุณากรอกข้อมูล',
            'mem_name.min' => 'ต้องมีอย่างน้อย :min ตัวอักษร',
            'mem_username.required' => 'กรุณากรอกชื่อผู้ใช้',
            'mem_username.min' => 'ต้องมีอย่างน้อย :min ตัวอักษร',
            'mem_email.required' => 'กรุณากรอกอีเมล',
            'mem_email.email' => 'รูปแบบอีเมลไม่ถูกต้อง',
            'mem_phone.required' => 'กรุณากรอกเบอร์โทร',
            'mem_phone.min' => 'ต้องมีอย่างน้อย :min',
            'mem_phone.max' => 'ห้ามเกิน :max',
            'mem_dob.required' => 'กรุณาเลือกวันเกิด',
            'mem_pic.mimes' => 'รองรับ jpeg, png, jpg เท่านั้น !!',
            'mem_pic.max' => 'ขนาดไฟล์ไม่เกิน 5MB',
        ];

        $validator = Validator::make($request->all(), [
            'mem_name'  => 'required|min:3',
            'mem_username' => [
                'required',
                'min:3',
                Rule::unique('tbl_member', 'mem_username')->ignore($member->mem_id, 'mem_id'),
            ],
            'mem_email' => [
                'required','email',
                Rule::unique('tbl_member', 'mem_email')->ignore($member->mem_id, 'mem_id'),
            ],
            'mem_phone' => 'required|max:10|min:10',
            'mem_dob'   => 'required|date',
            'mem_pic'   => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // 📂 อัปโหลดรูปใหม่ + ลบไฟล์เก่า
        if ($request->hasFile('mem_pic')) {
            if ($member->mem_pic && $member->mem_pic != 'default.png') {
                $oldPath = public_path('uploads/member/'.$member->mem_pic);
                if (file_exists($oldPath)) unlink($oldPath);
            }

            $file = $request->file('mem_pic');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/member'), $filename);

            $member->mem_pic = $filename;
        }

        // 📂 อัปเดตข้อมูลอื่น
        $member->mem_name = strip_tags($request->mem_name);
        $member->mem_email = strip_tags($request->mem_email);
        $member->mem_username = strip_tags($request->mem_username);
        $member->mem_phone = strip_tags($request->mem_phone);
        $member->mem_dob = $request->mem_dob;

        $member->save();

        return back()->with('success', 'อัปเดตโปรไฟล์เรียบร้อย ✅');
    }

    // 📌 Member Info
    public function memberinfo()
    {
        $member = Auth::guard('member')->user();
        return view('member.memberinfo', compact('member'));
    }

    // 📌 เปลี่ยนรหัสผ่าน
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password'          => 'required',
            'new_password'              => 'required|min:6|confirmed',
            'new_password_confirmation' => 'required'
        ]);

        $member = Auth::guard('member')->user();

        if (!Hash::check($request->current_password, $member->mem_password)) {
            return back()->withErrors(['current_password' => 'รหัสผ่านปัจจุบันไม่ถูกต้อง ❌']);
        }

        $member->mem_password = Hash::make($request->new_password);
        $member->save();

        return back()->with('success', 'เปลี่ยนรหัสผ่านเรียบร้อย 🎉');
    }

    // 📌 อัปโหลด/เปลี่ยน Avatar
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'mem_pic' => 'nullable|image|mimes:jpg,png,jpeg|max:5120',
        ]);

        $member = Auth::guard('member')->user();

        if ($request->hasFile('mem_pic')) {
            if ($member->mem_pic && $member->mem_pic != 'default.png') {
                $oldPath = public_path('uploads/member/'.$member->mem_pic);
                if (file_exists($oldPath)) unlink($oldPath);
            }

            $file = $request->file('mem_pic');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/member'), $filename);

            $member->mem_pic = $filename;
            $member->save();
        }

        return back()->with('success', 'อัปเดตรูปโปรไฟล์เรียบร้อย 🖼️');
    }

    // 📌 ลบ Avatar
    public function deleteAvatar()
    {
        $member = Auth::guard('member')->user();

        if ($member->mem_pic && $member->mem_pic != 'default.png') {
            $oldPath = public_path('uploads/member/'.$member->mem_pic);
            if (file_exists($oldPath)) unlink($oldPath);
        }

        $member->mem_pic = 'default.png';
        $member->save();

        return back()->with('success', 'ลบรูปโปรไฟล์เรียบร้อย ✅');
    }

    // 📌 เมนูโปรด
    public function favorites()
    {
        $member = Auth::guard('member')->user();
        $favorites = Favorite::with('menu')->where('mem_id', $member->mem_id)->get();

        return view('member.favorites', compact('favorites'));
    }

    // 📌 ลบเมนูโปรด
    public function removeFavorite($menu_id)
    {
        $member = Auth::guard('member')->user();

        Favorite::where('mem_id', $member->mem_id)
                ->where('menu_id', $menu_id)
                ->delete();

        return back()->with('success', 'ลบออกจากเมนูโปรดแล้ว ❌');
    }

    // 📌 ลบบัญชี
    public function deleteAccount(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);

        $member = Auth::guard('member')->user();

        if (!Hash::check($request->password, $member->mem_password)) {
            return back()->withErrors(['password' => 'รหัสผ่านไม่ถูกต้อง ❌']);
        }

        Auth::guard('member')->logout();

        // 🔹 ถ้าไม่อยากลบจริง ๆ → ให้ใช้ SoftDeletes ที่ Model
        $member->delete();

        return redirect()->route('login')
            ->with('account_deleted', 'บัญชีของคุณถูกลบเรียบร้อย ❌');
    }
}