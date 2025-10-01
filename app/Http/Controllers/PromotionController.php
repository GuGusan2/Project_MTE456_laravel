<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; //รับค่าจากฟอร์ม
use Illuminate\Support\Facades\Validator; //form validation
use RealRashid\SweetAlert\Facades\Alert; //sweet alert
use Illuminate\Support\Facades\Storage; //สำหรับเก็บไฟล์ภาพ
use Illuminate\Pagination\Paginator; //แบ่งหน้า
use App\Models\PromotionModel; //model
use Illuminate\Support\Facades\Auth;



class PromotionController extends Controller
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
        $promotions = PromotionModel::orderBy('pro_id', 'desc')->paginate(5); //order by & pagination
        //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
        return view('promotions.list', compact('promotions'));
    }

    public function adding()
    {
        return view('promotions.create');
    }


    public function create(Request $request)
    {
        //msg
        $messages = [
            'conditions.required' => 'กรุณากรอกข้อมูล',
            'detail.required' => 'กรุณากรอกรายละเอียดโปรโมชัน',
            'detail.min' => 'ต้องมีอย่างน้อย :min ตัวอักษร',
            'start_date.required' => 'ห้ามว่าง',
            'end_date.required' => 'ห้ามว่าง',
            'pro_pic.mimes' => 'รองรับ jpeg, png, jpg เท่านั้น !!',
            'pro_pic.max' => 'ขนาดไฟล์ไม่เกิน 5MB !!',
        ];

        //rule ตั้งขึ้นว่าจะเช็คอะไรบ้าง
        $validator = Validator::make($request->all(), [
            'conditions' => 'required|min:3',
            'detail' => 'required|min:10',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'pro_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ], $messages);


        //ถ้าผิดกฏให้อยู่หน้าเดิม และแสดง msg ออกมา
        if ($validator->fails()) {
            return redirect('promotion/adding')
                ->withErrors($validator)
                ->withInput();
        }


        //ถ้ามีการอัพโหลดไฟล์เข้ามา ให้อัพโหลดไปเก็บยังโฟลเดอร์ uploads/promotion
        try {
            $imagePath = null;
            if ($request->hasFile('pro_pic')) {
                $imagePath = $request->file('pro_pic')->store('uploads/promotion', 'public');
            }

            //insert เพิ่มข้อมูลลงตาราง
            PromotionModel::create([
                'conditions' => strip_tags($request->conditions),
                'detail' => strip_tags($request->detail),
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'pro_pic' => $imagePath,
            ]);

            //แสดง sweet alert
            Alert::success('Insert Successfully');
            return redirect('/promotion');
        } catch (\Exception $e) {  //error debug
            return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            // return view('errors.404');
        }
    } //create 

    public function edit($pro_id)
    {
        try {
            $pro = PromotionModel::findOrFail($pro_id); // ใช้ findOrFail เพื่อให้เจอหรือ 404

            //ประกาศตัวแปรเพื่อส่งไปที่ view
            if (isset($pro)) {
                $pro_id = $pro->pro_id;
                $conditions = $pro->conditions;
                $detail = $pro->detail;
                $end_date = $pro->end_date;
                $start_date = $pro->start_date;
                $pro_pic = $pro->pro_pic;
                return view('promotions.edit', compact('pro_id', 'conditions', 'detail', 'end_date', 'pro_pic', 'start_date'));
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            // return view('errors.404');
        }
    } //func edit

    public function update($pro_id, Request $request)
    {

        //error msg
        $messages = [
            'conditions.required' => 'กรุณากรอกข้อมูล',
            'detail.required' => 'กรุณากรอกรายละเอียดโปรโมชัน',
            'detail.min' => 'ต้องมีอย่างน้อย :min ตัวอักษร',
            'start_date.required' => 'ห้ามว่าง',
            'end_date.required' => 'ห้ามว่าง',
            'pro_pic.mimes' => 'รองรับ jpeg, png, jpg เท่านั้น !!',
            'pro_pic.max' => 'ขนาดไฟล์ไม่เกิน 5MB !!',
        ];


        // ตรวจสอบข้อมูลจากฟอร์มด้วย Validator
        $validator = Validator::make($request->all(), [
            'conditions' => 'required|min:3',
            'detail' => 'required|min:10',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'pro_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ], $messages);

        // ถ้า validation ไม่ผ่าน ให้กลับไปหน้าฟอร์มพร้อมแสดง error และข้อมูลเดิม
        if ($validator->fails()) {
            return redirect('promotion/' . $pro_id)
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // ดึงข้อมูลสินค้าตามไอดี ถ้าไม่เจอจะ throw Exception
            $pro = PromotionModel::findOrFail($pro_id);

            // ตรวจสอบว่ามีไฟล์รูปใหม่ถูกอัปโหลดมาหรือไม่
            if ($request->hasFile('pro_pic')) {
                // ถ้ามีรูปเดิมให้ลบไฟล์รูปเก่าออกจาก storage
                if ($pro->pro_pic) {
                    Storage::disk('public')->delete($pro->pro_pic);
                }
                // บันทึกไฟล์รูปใหม่ลงโฟลเดอร์ 'uploads/pro' ใน disk 'public'
                $imagePath = $request->file('pro_pic')->store('uploads/promotion', 'public');
                // อัปเดต path รูปภาพใหม่ใน model
                $pro->pro_pic = $imagePath;
            }

            $pro->conditions = strip_tags($request->conditions);
            $pro->detail = strip_tags($request->detail);
            $pro->start_date = $request->start_date;
            $pro->end_date = $request->end_date;

            // บันทึกการเปลี่ยนแปลงในฐานข้อมูล
            $pro->save();

            // แสดง SweetAlert แจ้งว่าบันทึกสำเร็จ
            Alert::success('Update Successfully');

            // เปลี่ยนเส้นทางกลับไปหน้ารายการสินค้า
            return redirect('/promotion');
        } catch (\Exception $e) {
            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    } //update  



    public function remove($pro_id)
    {
        try {
            $pro = PromotionModel::find($pro_id); //คิวรี่เช็คว่ามีไอดีนี้อยู่ในตารางหรือไม่

            if (!$pro) {   //ถ้าไม่มี
                Alert::error('promotion not found.');
                return redirect('promotion');
            }

            //ถ้ามีภาพ ลบภาพในโฟลเดอร์ 
            if ($pro->pro_pic && Storage::disk('public')->exists($pro->pro_pic)) {
                Storage::disk('public')->delete($pro->pro_pic);
            }

            // ลบข้อมูลจาก DB
            $pro->delete();

            Alert::success('Delete Successfully');
            return redirect('promotion');
        } catch (\Exception $e) {
            Alert::error('เกิดข้อผิดพลาด: ' . $e->getMessage());
            return redirect('promotion');
        }
    } //remove 


} //class