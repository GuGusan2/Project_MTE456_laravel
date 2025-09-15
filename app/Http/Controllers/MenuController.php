<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request; //รับค่าจากฟอร์ม
use Illuminate\Support\Facades\Validator; //form validation
use RealRashid\SweetAlert\Facades\Alert; //sweet alert
use Illuminate\Support\Facades\Storage; //สำหรับเก็บไฟล์ภาพ
use Illuminate\Pagination\Paginator; //แบ่งหน้า
use App\Models\MenuModel; //model



class MenuController extends Controller
{

    public function index(){
        Paginator::useBootstrap(); // ใช้ Bootstrap pagination
        $menus = MenuModel::orderBy('menu_id', 'desc')->paginate(5); //order by & pagination
         //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
        return view('menus.list', compact('menus'));
    }

    public function adding() {
        return view('menus.create');
    }


public function create(Request $request)
{
    //msg
    $messages = [
        'menu_name.required' => 'กรุณากรอกชื่อสินค้า',
        'menu_name.min' => 'ต้องมีอย่างน้อย :min ตัวอักษร',
        'menu_type.required' => 'กรุณาเลือกประเภทเมนู',
        'menu_detail.required' => 'กรุณากรอกรายละเอียดสินค้า',
        'menu_detail.min' => 'ต้องมีอย่างน้อย :min ตัวอักษร',
        'price.required' => 'ห้ามว่าง',
        'price.integer' => 'ใส่ตัวเลขเท่านั้น',
        'price.min' => 'ขั้นต่ำมากกว่า 1',
        'menu_pic.mimes' => 'รองรับ jpeg, png, jpg เท่านั้น !!',
        'menu_pic.max' => 'ขนาดไฟล์ไม่เกิน 5MB !!',
    ];

    //rule ตั้งขึ้นว่าจะเช็คอะไรบ้าง
    $validator = Validator::make($request->all(), [
        'menu_name' => 'required|min:3',
        'menu_detail' => 'required|min:10',
        'menu_type' => 'required|in:food,beverage,sweet',
        'price' => 'required|integer|min:1',
        'menu_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
    ], $messages);
    

    //ถ้าผิดกฏให้อยู่หน้าเดิม และแสดง msg ออกมา
    if ($validator->fails()) {
        return redirect('menu/adding')
            ->withErrors($validator)
            ->withInput();
    }


    //ถ้ามีการอัพโหลดไฟล์เข้ามา ให้อัพโหลดไปเก็บยังโฟลเดอร์ uploads/menu
    try {
        $imagePath = null;
        if ($request->hasFile('menu_pic')) {
            $imagePath = $request->file('menu_pic')->store('uploads/menu', 'public');
        }

        //insert เพิ่มข้อมูลลงตาราง
        MenuModel::create([
            'menu_name' => strip_tags($request->menu_name),
            'menu_type' => strip_tags($request->menu_type),
            'menu_detail' => strip_tags($request->menu_detail),
            'price' => $request->price,
            'menu_pic' => $imagePath,
        ]);

        //แสดง sweet alert
        Alert::success('Insert Successfully');
        return redirect('/menu');

    } catch (\Exception $e) {  //error debug
        return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
        // return view('errors.404');
    }
} //create 

public function edit($menu_id)
    {
        try {
            $menu = MenuModel::findOrFail($menu_id); // ใช้ findOrFail เพื่อให้เจอหรือ 404

            //ประกาศตัวแปรเพื่อส่งไปที่ view
            if (isset($menu)) {
                $menu_id = $menu->menu_id;
                $menu_name = $menu->menu_name;
                $menu_type = $menu->menu_type;
                $menu_detail = $menu->menu_detail;
                $price = $menu->price;
                $menu_pic = $menu->menu_pic;
                return view('menus.edit', compact('menu_id', 'menu_name', 'menu_type', 'price', 'menu_pic','menu_detail'));
            }
        } catch (\Exception $e) {
            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    } //func edit

public function update($menu_id, Request $request)
{

    //error msg
     $messages = [
        'menu_name.required' => 'กรุณากรอกชื่อสินค้า',
        'menu_name.min' => 'ต้องมีอย่างน้อย :min ตัวอักษร',
        'menu_type.required' => 'กรุณาเลือกประเภทเมนู',
        'menu_detail.required' => 'กรุณากรอกรายละเอียดสินค้า',
        'menu_detail.min' => 'ต้องมีอย่างน้อย :min ตัวอักษร',
        'price.required' => 'ห้ามว่าง',
        'price.integer' => 'ใส่ตัวเลขเท่านั้น',
        'price.min' => 'ขั้นต่ำมากกว่า 1',
        'menu_pic.mimes' => 'รองรับ jpeg, png, jpg เท่านั้น !!',
        'menu_pic.max' => 'ขนาดไฟล์ไม่เกิน 5MB !!',
    ];


    // ตรวจสอบข้อมูลจากฟอร์มด้วย Validator
    $validator = Validator::make($request->all(), [
        'menu_name' => 'required|min:3',
        'menu_type' => 'required|in:food,beverage,sweet',
        'price' => 'required|integer|min:1',
        'menu_detail' => 'required|min:10',
        'menu_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
    ], $messages);

    // ถ้า validation ไม่ผ่าน ให้กลับไปหน้าฟอร์มพร้อมแสดง error และข้อมูลเดิม
    if ($validator->fails()) {
        return redirect('menu/' . $menu_id)
            ->withErrors($validator)
            ->withInput();
    }

    try {
        // ดึงข้อมูลสินค้าตามไอดี ถ้าไม่เจอจะ throw Exception
        $menu = MenuModel::findOrFail($menu_id);

        // ตรวจสอบว่ามีไฟล์รูปใหม่ถูกอัปโหลดมาหรือไม่
        if ($request->hasFile('menu_pic')) {
            // ถ้ามีรูปเดิมให้ลบไฟล์รูปเก่าออกจาก storage
            if ($menu->menu_pic) {
                Storage::disk('public')->delete($menu->menu_pic);
            }
            // บันทึกไฟล์รูปใหม่ลงโฟลเดอร์ 'uploads/menu' ใน disk 'public'
            $imagePath = $request->file('menu_pic')->store('uploads/menu', 'public');
            // อัปเดต path รูปภาพใหม่ใน model
            $menu->menu_pic = $imagePath;
        }

        // อัปเดตชื่อสินค้า โดยใช้ strip_tags ป้องกันการแทรกโค้ด HTML/JS
        $menu->menu_name = strip_tags($request->menu_name);
        // อัปเดตรายละเอียดสินค้า โดยใช้ strip_tags ป้องกันการแทรกโค้ด HTML/JS
        $menu->menu_type = strip_tags($request->menu_type);
        $menu->menu_detail = strip_tags($request->menu_detail);
        // อัปเดตราคาสินค้า
        $menu->price = $request->price;

        // บันทึกการเปลี่ยนแปลงในฐานข้อมูล
        $menu->save();

        // แสดง SweetAlert แจ้งว่าบันทึกสำเร็จ
        Alert::success('Update Successfully');

        // เปลี่ยนเส้นทางกลับไปหน้ารายการสินค้า
        return redirect('/menu');

    } catch (\Exception $e) {
       //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
        return view('errors.404');

         //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
        //return view('errors.404');
    }
} //update  



public function remove($menu_id)
{
    try {
        $menu = MenuModel::find($menu_id); //คิวรี่เช็คว่ามีไอดีนี้อยู่ในตารางหรือไม่

        if (!$menu) {   //ถ้าไม่มี
            Alert::error('menu not found.');
            return redirect('menu');
        }

        //ถ้ามีภาพ ลบภาพในโฟลเดอร์ 
        if ($menu->menu_pic && Storage::disk('public')->exists($menu->menu_pic)) {
            Storage::disk('public')->delete($menu->menu_pic);
        }

        // ลบข้อมูลจาก DB
        $menu->delete();

        Alert::success('Delete Successfully');
        return redirect('menu');

    } catch (\Exception $e) {
        Alert::error('เกิดข้อผิดพลาด: ' . $e->getMessage());
        return redirect('menu');
    }
} //remove 

    // ฟังก์ชันแสดงลิส พร้อมค้นหา
    public function searchMenu(Request $request)
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
            $menus = MenuModel::where('menu_name', 'like', "%{$keyword}%")
                ->paginate(5);  // แสดงหน้า ละ 5 รายการ
        } else {
            // ถ้าไม่มี keyword ให้แสดง employee ทั้งหมด เรียงตาม id จากมากไปน้อย
            $menus = MenuModel::orderBy('menu_id', 'desc')
                ->paginate(5);  // แสดงหน้า ละ 5 รายการ
            
        }

        // ส่งตัวแปร emps และ keyword ไปที่หน้า view
        return view('backsearch.menu_index', compact('menus', 'keyword'));
    }
    
    // ฟังก์ชันแสดงลิส พร้อมค้นหา
    public function searchfilter(Request $request)
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
            $menus = MenuModel::where('menu_type', '=', "{$keyword}")
                ->paginate(5);  // แสดงหน้า ละ 5 รายการ
        } else {
            // ถ้าไม่มี keyword ให้แสดง employee ทั้งหมด เรียงตาม id จากมากไปน้อย
            $menus = MenuModel::orderBy('menu_id', 'desc')
                ->paginate(5);  // แสดงหน้า ละ 5 รายการ
            
        }

        // ส่งตัวแปร emps และ keyword ไปที่หน้า view
        return view('backsearch.menu_index', compact('menus', 'keyword'));
    }


} //class