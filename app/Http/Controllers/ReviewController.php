<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\MenuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // 📌 แสดงรีวิวของเมนู
    public function index($menu_id)
    {
        $menu = MenuModel::with(['reviews.member'])->findOrFail($menu_id);

        return view('member.reviews', [
            'menu' => $menu,
            'reviews' => $menu->reviews, // ดึงรีวิวผ่าน relationship
            'menu_id' => $menu_id,
        ]);
    }

    // 📌 บันทึกรีวิว
    public function store(Request $request, $menu_id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        $memberId = Auth::guard('member')->id();

        if (!$memberId) {
            return redirect()->route('login')
                ->with('error', 'กรุณาเข้าสู่ระบบก่อนจึงจะรีวิวได้ ❌');
        }

        Review::create([
            'mem_id' => $memberId,
            'menu_id' => $menu_id,
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);

        // ✅ ดึง URL ก่อนหน้า ถ้าไม่มี fallback ไปหน้าเมนู
        $previous = session('previous_url', route('member.menu'));

        return redirect()->route('member.menudetail', $menu_id)
            ->with('success', 'รีวิวถูกบันทึกแล้ว! ✅')
            ->with('previous_url', $previous);
    }
}

