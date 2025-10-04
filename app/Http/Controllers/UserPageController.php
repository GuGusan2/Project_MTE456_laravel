<?php

namespace App\Http\Controllers;

use App\Models\CounterModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\MenuModel;
use App\Models\PromotionModel;
use Illuminate\Support\Facades\DB; //raw sql

class UserPageController extends Controller
{
    // 🏠 หน้า Home → แสดงเมนูแนะนำ (3 เมนู)
    public function home()
    {

        DB::table('tbl_count_view')->insert([
            ['timestamp' => now()]
        ]);

        $menus = MenuModel::take(3)->get(); // ดึงมา 3 เมนูจาก DB
        $promotions = PromotionModel::orderBy('start_date', 'desc')->get();
        return view('user.home', compact('menus', 'promotions'));
    }

    // 🍽 หน้าเมนูทั้งหมด
    public function menu(Request $request)
    {
        $query = MenuModel::query();

        // ✅ ค้นหาตามชื่อเมนู
        if ($request->filled('search')) {
            $query->where('menu_name', 'like', '%' . $request->search . '%');
        }

        // ✅ เลือกประเภทเมนู (food, beverage, sweet ฯลฯ)
        if ($request->filled('menu_type')) {
            $query->where('menu_type', $request->menu_type);
        }

        // ✅ แสดงทีละ 8 เมนู พร้อม pagination + คงค่า search/filter ตอนกดเปลี่ยนหน้า
        $menus = $query->paginate(8)->withQueryString();

        return view('user.menu', compact('menus'));
    }

    // 🎉 Banner (ตอนนี้ static ไว้ก่อน)
    public function banner()
    {
        return view('user.banner');
    }

    // 📄 แสดงรายละเอียดเมนู
    public function menudetail($id)
    {
        $menu = MenuModel::findOrFail($id); // ถ้าไม่เจอ → error 404

        CounterModel::create([
            'menu_id' => $id,
            'timestamp' => Carbon::now()
        ]);

        return view('user.menudetail', compact('menu'));
    }

    // 📞 หน้า Contact
    public function contact()
    {
        return view('user.contact');
    }
}
