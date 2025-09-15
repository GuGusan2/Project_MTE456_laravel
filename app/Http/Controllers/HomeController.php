<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request; //รับค่าจากฟอร์ม
use Illuminate\Support\Facades\Validator; //form validation
use RealRashid\SweetAlert\Facades\Alert; //sweet alert
use Illuminate\Support\Facades\Storage; //สำหรับเก็บไฟล์ภาพ
use Illuminate\Pagination\Paginator; //แบ่งหน้า
use App\Models\MenuModel; //model

use Illuminate\Support\Facades\DB; //raw sql

class HomeController extends Controller
{

    public function index(){
        Paginator::useBootstrap(); // ใช้ Bootstrap pagination
        $menus = MenuModel::orderBy('menu_id', 'desc')->paginate(5); //order by & pagination
         //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug

        DB::table('tbl_count_view')->insert([
            ['timestamp' => now()]
        ]);

        return view('home.banner', compact('menus'));
    }

    public function adding() {
        return view('menus.create');
    }

} //class