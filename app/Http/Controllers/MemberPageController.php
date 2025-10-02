<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MenuModel;
use App\Models\PromotionModel;

class MemberPageController extends Controller
{
    // 🏠 หน้า Home
    public function home()
    {
        $menus = MenuModel::orderBy('timestamp', 'desc')->take(3)->get(); // ⬅️ จาก 4 → 3
        $promotions = PromotionModel::orderBy('start_date', 'desc')->get();

        return view('member.home', compact('menus', 'promotions'));
    }

    // 🍽 หน้าเมนู
    public function menu(Request $request)
    {
        // ดึงประเภทอาหารทั้งหมดจาก menu_type
        $categories = MenuModel::select('menu_type')
            ->distinct()
            ->pluck('menu_type');

        // query หลัก
        $query = MenuModel::orderBy('timestamp', 'desc');

        // 🔍 ค้นหาชื่อเมนู
        if ($request->filled('search')) {
            $query->where('menu_name', 'LIKE', '%' . $request->search . '%');
        }

        // 📌 เลือกประเภทอาหาร
        if ($request->filled('menu_type')) {
            $query->where('menu_type', $request->menu_type);
        }

        // ✅ แบ่งหน้า
        $menus = $query->paginate(9);

        return view('member.menu', compact('menus', 'categories'));
    }

    // 🎁 หน้าโปรโมชั่น
    public function promotion()
    {
        $promotions = PromotionModel::orderBy('start_date', 'desc')->paginate(6);
        return view('member.promotion', compact('promotions'));
    }

    // 📞 หน้าติดต่อ
    public function contact()
    {
        return view('member.contact');
    }

    // 👤 หน้าโปรไฟล์
    public function profile()
    {
        $member = Auth::guard('member')->user();
        return view('member.profile', compact('member'));
    }

    // 📌 รายละเอียดเมนู
    public function menudetail($id, Request $request)
    {
        // เก็บ URL ก่อนหน้าลง session (ถ้าไม่ใช่ menudetail เอง)
        if (!str_contains(url()->previous(), '/member/menu/')) {
            session(['previous_url' => url()->previous()]);
        }

        $menu = MenuModel::with(['reviews.member'])->findOrFail($id);

        return view('member.menudetail', compact('menu'));
    }
}
