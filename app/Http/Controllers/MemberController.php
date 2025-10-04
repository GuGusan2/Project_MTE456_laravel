<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; //รับค่าจากฟอร์ม
use Illuminate\Support\Facades\Validator; //form validation
use RealRashid\SweetAlert\Facades\Alert; //sweet alert
use Illuminate\Support\Facades\Storage; //สำหรับเก็บไฟล์ภาพ
use Illuminate\Pagination\Paginator; //แบ่งหน้า
use App\Models\MemberModel; //model
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


class MemberController extends Controller
{
    public function __construct()
    {
        // ใช้ middleware 'auth:admin' เพื่อบังคับให้ต้องล็อกอินในฐานะ admin ก่อนใช้งาน controller นี้
        // ถ้าไม่ล็อกอินหรือไม่ได้ใช้ guard 'admin' จะถูก redirect ไปหน้า login
        $this->middleware('auth:admin');

        // เช็คว่าเป็น admin หรือ staff
        $this->middleware(function ($request, $next) {
            if (!in_array(session('role'), ['admin', 'staff'])) {
                return redirect('login');
            }
            return $next($request);
        });
    }

    public function index()
    {
        Paginator::useBootstrap(); // ใช้ Bootstrap pagination
        $members = MemberModel::orderBy('mem_id', 'desc')->paginate(5); //order by & pagination
        //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
        return view('members.list', compact('members'));
    }

    public function adding()
    {
        return view('members.create');
    }


    public function create(Request $request)
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

            'mem_phone.required' => 'กรุณากรอกข้อมูล',
            'mem_phone.min' => 'ต้องมีอย่างน้อย :min',
            'mem_phone.max' => 'ห้ามเกิน :max',

            'mem_gender.required' => 'กรุณาเลือก',
            'mem_dob.required' => 'กรุณาเลือก',

            'mem_pic.mimes' => 'รองรับ jpeg, png, jpg เท่านั้น !!',
            'mem_pic.max' => 'ขนาดไฟล์ไม่เกิน',
        ];

        //rule ตั้งขึ้นว่าจะเช็คอะไรบ้าง
        $validator = Validator::make($request->all(), [
            'mem_username' => 'required|min:2|unique:tbl_member',
            'mem_email' => 'required|email|min:3|unique:tbl_member',
            'mem_name' => 'required|min:3',
            'mem_password' => 'required|min:3',
            'mem_gender' => 'required|in:male,female',
            'mem_dob' => 'required|date',
            'mem_phone' => 'required|max:10|min:10',
            'mem_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ], $messages);


        //ถ้าผิดกฏให้อยู่หน้าเดิม และแสดง msg ออกมา
        if ($validator->fails()) {
            return redirect('member/adding')
                ->withErrors($validator)
                ->withInput();
        }


        //ถ้ามีการอัพโหลดไฟล์เข้ามา ให้อัพโหลดไปเก็บยังโฟลเดอร์ uploads/student
        try {
            $imagePath = null;
            if ($request->hasFile('mem_pic')) {
                $imagePath = $request->file('mem_pic')->store('uploads/member', 'public');
            }

            //insert เพิ่มข้อมูลลงตาราง
            MemberModel::create([
                'mem_username' => strip_tags($request->mem_username),
                'mem_name' => strip_tags($request->mem_name),
                'mem_email' => strip_tags($request->mem_email),
                'mem_password' => bcrypt($request->mem_password),
                'mem_phone' => strip_tags($request->mem_phone),
                'mem_dob' => $request->mem_dob,
                'mem_gender' => $request->mem_gender,
                'mem_pic' => $imagePath,
            ]);

            //แสดง sweet alert
            Alert::success('Insert Successfully');
            return redirect('/member');
        } catch (\Exception $e) {  //error debug
            return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            // return view('errors.404');
        }
    } //create 

    public function edit($mem_id)
    {
        try {
            $members = MemberModel::findOrFail($mem_id); // ใช้ findOrFail เพื่อให้เจอหรือ 404

            //ประกาศตัวแปรเพื่อส่งไปที่ view
            if (isset($members)) {
                $mem_id = $members->mem_id;
                $mem_name = $members->mem_name;
                $mem_username = $members->mem_username;
                $mem_email = $members->mem_email;
                $mem_dob = $members->mem_dob;
                $mem_gender = $members->mem_gender;
                $mem_phone = $members->mem_phone;
                $mem_pic = $members->mem_pic;
                return view('members.edit', compact('mem_id', 'mem_name', 'mem_username', 'mem_email', 'mem_dob', 'mem_gender', 'mem_phone', 'mem_pic'));
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            // return view('errors.404');
        }
    } //func edit

    public function update($mem_id, Request $request)
    {

        //error msg
        $messages = [
            'mem_name.required' => 'กรุณากรอกข้อมูล',
            'mem_name.min' => 'ต้องมีอย่างน้อย :min ตัวอักษร',

            'mem_username.unique' => 'ข้อมูลซ้ำ',
            'mem_username.required' => 'กรุณากรอกข้อมูล',
            'mem_username.min' => 'ต้องมีอย่างน้อย :min ตัวอักษร',

            'mem_email.unique' => 'Email ซ้ำ เพิ่มใหม่อีกครั้ง  !!',
            'mem_email.required' => 'กรุณากรอกข้อมูล',
            'mem_email.email' => 'รูปแบบอีเมลไม่ถูกต้อง',

            'mem_phone.required' => 'กรุณากรอกข้อมูล',
            'mem_phone.min' => 'ต้องมีอย่างน้อย :min',
            'mem_phone.max' => 'ห้ามเกิน :max',

            'mem_gender.required' => 'กรุณาเลือก',
            'mem_dob.required' => 'กรุณาเลือก',

            'mem_pic.mimes' => 'รองรับ jpeg, png, jpg เท่านั้น !!',
            'mem_pic.max' => 'ขนาดไฟล์ไม่เกิน',
        ];


        // ตรวจสอบข้อมูลจากฟอร์มด้วย Validator
        $validator = Validator::make($request->all(), [
            'mem_username' => [
                'required',
                'min:2',
                Rule::unique('tbl_member', 'mem_username')->ignore($mem_id, 'mem_id'), //ห้ามแก้ซ้ำ
            ],
            'mem_email' => [
                'required',
                'min:3',
                'email',
                Rule::unique('tbl_member', 'mem_email')->ignore($mem_id, 'mem_id'), //ห้ามแก้ซ้ำ
            ],
            'mem_name' => 'required|min:3',
            'mem_gender' => 'required|in:male,female',
            'mem_dob' => 'required|date',
            'mem_phone' => 'required|max:10|min:10',
            'mem_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ], $messages);

        // ถ้า validation ไม่ผ่าน ให้กลับไปหน้าฟอร์มพร้อมแสดง error และข้อมูลเดิม
        if ($validator->fails()) {
            return redirect('member/' . $mem_id)
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // ดึงข้อมูลสินค้าตามไอดี ถ้าไม่เจอจะ throw Exception
            $members = MemberModel::findOrFail($mem_id);

            // ตรวจสอบว่ามีไฟล์รูปใหม่ถูกอัปโหลดมาหรือไม่
            if ($request->hasFile('mem_pic')) {
                // ถ้ามีรูปเดิมให้ลบไฟล์รูปเก่าออกจาก storage
                if ($members->mem_pic) {
                    Storage::disk('public')->delete($members->mem_pic);
                }
                // บันทึกไฟล์รูปใหม่ลงโฟลเดอร์ 'uploads/member' ใน disk 'public'
                $imagePath = $request->file('mem_pic')->store('uploads/member', 'public');
                // อัปเดต path รูปภาพใหม่ใน model
                $members->mem_pic = $imagePath;
            }

            // อัปเดตชื่อ โดยใช้ strip_tags ป้องกันการแทรกโค้ด HTML/JS
            $members->mem_name = strip_tags($request->mem_name);
            $members->mem_email = strip_tags($request->mem_email);
            $members->mem_username = strip_tags($request->mem_username);
            $members->mem_phone = strip_tags($request->mem_phone);
            $members->mem_dob = $request->mem_dob;
            $members->mem_gender = $request->mem_gender;

            // บันทึกการเปลี่ยนแปลงในฐานข้อมูล
            $members->save();

            // แสดง SweetAlert แจ้งว่าบันทึกสำเร็จ
            Alert::success('Update Successfully');

            // เปลี่ยนเส้นทางกลับไปหน้ารายการสินค้า
            return redirect('/member');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            // return view('errors.404');
        }
    } //update  



    public function remove($mem_id)
    {
        try {
            $members = MemberModel::find($mem_id); //คิวรี่เช็คว่ามีไอดีนี้อยู่ในตารางหรือไม่

            if (!$members) {   //ถ้าไม่มี
                Alert::error('Member not found.');
                return redirect('member');
            }

            //ถ้ามีภาพ ลบภาพในโฟลเดอร์ 
            if ($members->mem_pic && Storage::disk('public')->exists($members->mem_pic)) {
                Storage::disk('public')->delete($members->mem_pic);
            }

            // ลบข้อมูลจาก DB
            $members->delete();

            Alert::success('Delete Successfully');
            return redirect('member');
        } catch (\Exception $e) {
            Alert::error('เกิดข้อผิดพลาด: ' . $e->getMessage());
            return redirect('member');
        }
    } //remove 

    public function reset($mem_id)
    {
        try {
            //query data for form edit 
            $members = MemberModel::findOrFail($mem_id); // ใช้ findOrFail เพื่อให้เจอหรือ 404
            if (isset($members)) {
                $mem_id = $members->mem_id;
                $mem_username = $members->mem_username;
                $mem_name = $members->mem_name;
                return view('members.editPassword', compact('mem_id', 'mem_name', 'mem_username'));
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            // return view('errors.404');
        }
    } //func reset

    public function resetPassword($mem_id, Request $request)
    {
        //vali msg 
        $messages = [
            'password.required' => 'กรุณากรอกข้อมูล',
            'password.min' => 'กรอกข้อมูลขั้นต่ำ :min ตัว',
            'password.confirmed' => 'not match !!',

            'password_confirmation.required' => 'กรุณากรอกข้อมูล',
            'password_confirmation.min' => 'at least 3 characters',

        ];

        //rule
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:3|confirmed',
            'password_confirmation' => 'required|min:3',
        ], $messages);

        //check 
        if ($validator->fails()) {
            return redirect('member/reset/' . $mem_id)
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $members = MemberModel::find($mem_id);
            $members->update([
                'mem_password' => bcrypt($request->input('password')),
            ]);
            // แสดง Alert ก่อน return
            Alert::success('เปลี่ยนรหัสผ่านสำเร็จ');
            return redirect('/member');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            //return view('errors.404');
        }
    } //fun resetPassword

    // ฟังก์ชันแสดงลิส พร้อมค้นหา
    public function searchMember(Request $request)
    {
        // ตรวจสอบค่าที่ส่งมา (debug)
        // print_r($_GET);
        // exit;

        // ใช้ Bootstrap style ใน pagination
        Paginator::useBootstrap();

        // รับค่าคีย์เวิร์ดจากฟอร์มหรือ URL
        $keyword = $request->keyword;

        // ถ้ามีการกรอก keyword เข้ามา
        if (strlen($keyword) > 0) {
            // ค้นหาจากชื่อ member (mem_name) โดยใช้ LIKE
            $members = MemberModel::where('mem_name', 'like', "%{$keyword}%")
                ->paginate(5);  // แสดงหน้า ละ 5 รายการ
        } else {
            // ถ้าไม่มี keyword ให้แสดง employee ทั้งหมด เรียงตาม id จากมากไปน้อย
            $members = MemberModel::orderBy('mem_id', 'desc')
                ->paginate(5);  // แสดงหน้า ละ 5 รายการ
        }

        // ส่งตัวแปร emps และ keyword ไปที่หน้า view
        return view('backsearch.mem_index', compact('members', 'keyword'));
    }
} //class