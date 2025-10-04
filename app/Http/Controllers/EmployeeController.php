<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; //รับค่าจากฟอร์ม
use Illuminate\Support\Facades\Validator; //form validation
use RealRashid\SweetAlert\Facades\Alert; //sweet alert
use Illuminate\Support\Facades\Storage; //สำหรับเก็บไฟล์ภาพ
use Illuminate\Pagination\Paginator; //แบ่งหน้า
use App\Models\EmployeeModel; //model
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Auth;


class EmployeeController extends Controller
{
    public function __construct()
    {
        // ใช้ middleware 'auth:admin' เพื่อบังคับให้ต้องล็อกอินในฐานะ admin ก่อนใช้งาน controller นี้
        // ถ้าไม่ล็อกอินหรือไม่ได้ใช้ guard 'admin' จะถูก redirect ไปหน้า login
        $this->middleware('auth:admin');

        // เช็คว่าเป็น admin จริงไหม ?
        $this->middleware(function ($request, $next) {
            if (session('role') !== 'admin') {
                return redirect('login');
            }
            return $next($request);
        });
    }


    public function index()
    {
        Paginator::useBootstrap(); // ใช้ Bootstrap pagination
        $employees = EmployeeModel::orderBy('emp_id', 'desc')->paginate(5); //order by & pagination
        //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
        return view('employees.list', compact('employees'));
    }

    public function adding()
    {
        return view('employees.create');
    }


    public function create(Request $request)
    {
        //msg
        $messages = [
            'emp_name.required' => 'กรุณากรอกข้อมูล',
            'emp_name.min' => 'ต้องมีอย่างน้อย :min ตัวอักษร',

            'emp_username.required' => 'กรุณากรอกข้อมูล',
            'emp_username.unique' => 'ข้อมูลซ้ำ',
            'emp_username.min' => 'ต้องมีอย่างน้อย :min ตัวอักษร',

            'emp_email.required' => 'กรุณากรอกข้อมูล',
            'emp_email.email' => 'รูปแบบอีเมลไม่ถูกต้อง',
            'emp_email.unique' => 'Email ซ้ำ เพิ่มใหม่อีกครั้ง  !!',

            'emp_password.required' => 'กรุณากรอกข้อมูล',
            'emp_password.min' => 'กรอกข้อมูลขั้นต่ำ :min ตัว',

            'emp_phone.required' => 'กรุณากรอกข้อมูล',
            'emp_phone.min' => 'ต้องมีอย่างน้อย :min',
            'emp_phone.max' => 'ห้ามเกิน :max',

            'emp_gender.required' => 'กรุณาเลือก',
            'role.required' => 'กรุณาเลือก',

            'emp_dob.required' => 'กรุณาเลือก',
            'date.required' => 'กรุณาเลือก',

            'emp_pic.mimes' => 'รองรับ jpeg, png, jpg เท่านั้น !!',
            'emp_pic.max' => 'ขนาดไฟล์ไม่เกิน',
        ];

        //rule ตั้งขึ้นว่าจะเช็คอะไรบ้าง
        $validator = Validator::make($request->all(), [
            'emp_username' => 'required|min:3|unique:tbl_emp_admin',
            'emp_email' => 'required|email|min:3|unique:tbl_emp_admin',
            'emp_name' => 'required|min:3',
            'emp_password' => 'required|min:3',
            'emp_gender' => 'required|in:male,female',
            'emp_dob' => 'required|date',
            'date' => 'required|date',
            'role' => 'required|in:admin,staff',
            'emp_phone' => 'required|max:10|min:10',
            'emp_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ], $messages);


        //ถ้าผิดกฏให้อยู่หน้าเดิม และแสดง msg ออกมา
        if ($validator->fails()) {
            return redirect('employee/adding')
                ->withErrors($validator)
                ->withInput();
        }


        //ถ้ามีการอัพโหลดไฟล์เข้ามา ให้อัพโหลดไปเก็บยังโฟลเดอร์ uploads/student
        try {
            $imagePath = null;
            if ($request->hasFile('emp_pic')) {
                $imagePath = $request->file('emp_pic')->store('uploads/employee', 'public');
            }

            //insert เพิ่มข้อมูลลงตาราง
            EmployeeModel::create([
                'emp_username' => strip_tags($request->emp_username),
                'emp_name' => strip_tags($request->emp_name),
                'emp_email' => strip_tags($request->emp_email),
                'emp_password' => bcrypt($request->emp_password),
                'emp_phone' => strip_tags($request->emp_phone),
                'emp_dob' => $request->emp_dob,
                'date' => $request->date,
                'emp_gender' => $request->emp_gender,
                'role' => $request->role,
                'emp_pic' => $imagePath,
            ]);

            //แสดง sweet alert
            Alert::success('Insert Successfully');
            return redirect('/employee');
        } catch (\Exception $e) {  //error debug
            return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            // return view('errors.404');
        }
    } //create 

    public function edit($emp_id)
    {
        try {
            $employees = EmployeeModel::findOrFail($emp_id); // ใช้ findOrFail เพื่อให้เจอหรือ 404

            //ประกาศตัวแปรเพื่อส่งไปที่ view
            if (isset($employees)) {
                $emp_id = $employees->emp_id;
                $emp_name = $employees->emp_name;
                $emp_username = $employees->emp_username;
                $emp_email = $employees->emp_email;
                $emp_dob = $employees->emp_dob;
                $emp_gender = $employees->emp_gender;
                $role = $employees->role;
                $date = $employees->date;
                $emp_phone = $employees->emp_phone;
                $emp_pic = $employees->emp_pic;
                return view('employees.edit', compact('emp_id', 'emp_name', 'emp_username', 'emp_email', 'emp_dob', 'emp_gender', 'role', 'date', 'emp_phone', 'emp_pic'));
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            // return view('errors.404');
        }
    } //func edit

    public function update($emp_id, Request $request)
    {

        //error msg
        $messages = [
            'emp_name.required' => 'กรุณากรอกข้อมูล',
            'emp_name.min' => 'ต้องมีอย่างน้อย :min ตัวอักษร',

            'emp_username.unique' => 'ข้อมูลซ้ำ',
            'emp_username.required' => 'กรุณากรอกข้อมูล',
            'emp_username.min' => 'ต้องมีอย่างน้อย :min ตัวอักษร',

            'emp_email.unique' => 'Email ซ้ำ เพิ่มใหม่อีกครั้ง  !!',
            'emp_email.required' => 'กรุณากรอกข้อมูล',
            'emp_email.email' => 'รูปแบบอีเมลไม่ถูกต้อง',

            'emp_phone.required' => 'กรุณากรอกข้อมูล',
            'emp_phone.min' => 'ต้องมีอย่างน้อย :min',
            'emp_phone.max' => 'ห้ามเกิน :max',

            'emp_gender.required' => 'กรุณาเลือก',
            'role.required' => 'กรุณาเลือก',

            'emp_dob.required' => 'กรุณาเลือก',
            'date.required' => 'กรุณาเลือก',

            'emp_pic.mimes' => 'รองรับ jpeg, png, jpg เท่านั้น !!',
            'emp_pic.max' => 'ขนาดไฟล์ไม่เกิน',
        ];


        // ตรวจสอบข้อมูลจากฟอร์มด้วย Validator
        $validator = Validator::make($request->all(), [
            'emp_username' => [
                'required',
                'min:3',
                Rule::unique('tbl_emp_admin', 'emp_username')->ignore($emp_id, 'emp_id'), //ห้ามแก้ซ้ำ
            ],
            'emp_email' => [
                'required',
                'min:3',
                'email',
                Rule::unique('tbl_emp_admin', 'emp_email')->ignore($emp_id, 'emp_id'), //ห้ามแก้ซ้ำ
            ],
            'emp_name' => 'required|min:3',
            'emp_gender' => 'required|in:male,female',
            'emp_dob' => 'required|date',
            'date' => 'required|date',
            'role' => 'required|in:admin,staff',
            'emp_phone' => 'required|max:10|min:10',
            'emp_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ], $messages);

        // ถ้า validation ไม่ผ่าน ให้กลับไปหน้าฟอร์มพร้อมแสดง error และข้อมูลเดิม
        if ($validator->fails()) {
            return redirect('employee/' . $emp_id)
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // ดึงข้อมูลสินค้าตามไอดี ถ้าไม่เจอจะ throw Exception
            $employees = EmployeeModel::findOrFail($emp_id);

            // ตรวจสอบว่ามีไฟล์รูปใหม่ถูกอัปโหลดมาหรือไม่
            if ($request->hasFile('emp_pic')) {
                // ถ้ามีรูปเดิมให้ลบไฟล์รูปเก่าออกจาก storage
                if ($employees->emp_pic) {
                    Storage::disk('public')->delete($employees->emp_pic);
                }
                // บันทึกไฟล์รูปใหม่ลงโฟลเดอร์ 'uploads/employee' ใน disk 'public'
                $imagePath = $request->file('emp_pic')->store('uploads/employee', 'public');
                // อัปเดต path รูปภาพใหม่ใน model
                $employees->emp_pic = $imagePath;
            }

            // อัปเดตชื่อ โดยใช้ strip_tags ป้องกันการแทรกโค้ด HTML/JS
            $employees->emp_name = strip_tags($request->emp_name);
            $employees->emp_email = strip_tags($request->emp_email);
            $employees->emp_username = strip_tags($request->emp_username);
            $employees->emp_phone = strip_tags($request->emp_phone);
            $employees->emp_dob = $request->emp_dob;
            $employees->date = $request->date;
            $employees->role = $request->role;
            $employees->emp_gender = $request->emp_gender;

            // บันทึกการเปลี่ยนแปลงในฐานข้อมูล
            $employees->save();

            // แสดง SweetAlert แจ้งว่าบันทึกสำเร็จ
            Alert::success('Update Successfully');

            // เปลี่ยนเส้นทางกลับไปหน้ารายการสินค้า
            return redirect('/employee');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            // return view('errors.404');
        }
    } //update  



    public function remove($emp_id)
    {
        try {
            $employees = EmployeeModel::find($emp_id); //คิวรี่เช็คว่ามีไอดีนี้อยู่ในตารางหรือไม่

            if (!$employees) {   //ถ้าไม่มี
                Alert::error('Employee not found.');
                return redirect('employee');
            }

            //ถ้ามีภาพ ลบภาพในโฟลเดอร์ 
            if ($employees->emp_pic && Storage::disk('public')->exists($employees->emp_pic)) {
                Storage::disk('public')->delete($employees->emp_pic);
            }

            // ลบข้อมูลจาก DB
            $employees->delete();

            Alert::success('Delete Successfully');
            return redirect('employee');
        } catch (\Exception $e) {
            Alert::error('เกิดข้อผิดพลาด: ' . $e->getMessage());
            return redirect('employee');
        }
    } //remove 

    public function reset($emp_id)
    {
        try {
            //query data for form edit 
            $employees = EmployeeModel::findOrFail($emp_id); // ใช้ findOrFail เพื่อให้เจอหรือ 404
            if (isset($employees)) {
                $emp_id = $employees->emp_id;
                $emp_username = $employees->emp_username;
                $emp_name = $employees->emp_name;
                return view('employees.editPassword', compact('emp_id', 'emp_name', 'emp_username'));
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            // return view('errors.404');
        }
    } //func reset

    public function resetPassword($emp_id, Request $request)
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
            return redirect('employee/reset/' . $emp_id)
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $employees = EmployeeModel::find($emp_id);
            $employees->update([
                'emp_password' => bcrypt($request->input('password')),
            ]);
            // แสดง Alert ก่อน return
            Alert::success('เปลี่ยนรหัสผ่านสำเร็จ');
            return redirect('/employee');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            //return view('errors.404');
        }
    } //fun resetPassword

    // ฟังก์ชันแสดงลิส พร้อมค้นหา
    public function searchfilter(Request $request)
    {
        // ตรวจสอบค่าที่ส่งมา (debug)
        // print_r($_GET);
        // exit;

        // ใช้ Bootstrap style ใน pagination
        Paginator::useBootstrap();

        $query = EmployeeModel::query();

        // ค้นหาตามชื่อ
        if ($request->filled('search')) {
            $query->where('emp_name', 'like', '%' . $request->search . '%');
        }

        // เลือกประเภท
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $employees = $query->paginate(5)->withQueryString();
        // ส่งตัวแปร emps และ search ไปที่หน้า view
        return view('backsearch.emp_index', compact('employees'));
    }
} //class