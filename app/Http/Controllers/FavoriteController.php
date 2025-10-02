<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    // 📌 หน้าแสดงเมนูโปรด
    public function index()
    {
        $mem_id = Auth::guard('member')->user()->mem_id;
        $favorites = Favorite::with('menu')->where('mem_id', $mem_id)->get();
        return view('member.favorites', compact('favorites'));
    }

    // 📌 เพิ่มเมนูโปรด
    public function store(Request $request)
    {
        $favorite = Favorite::firstOrCreate([
            'mem_id' => Auth::guard('member')->user()->mem_id,
            'menu_id' => $request->menu_id,
        ]);

        if ($favorite->wasRecentlyCreated) {
            return back()->with('success', 'เพิ่มเมนูโปรดเรียบร้อยแล้ว 🎉');
        } else {
            return back()->with('info', 'เมนูนี้มีอยู่ในเมนูโปรดแล้ว ❤️');
        }
    }

    // 📌 ลบเมนูโปรด
    public function destroy($menu_id)
    {
        Favorite::where('mem_id', Auth::guard('member')->user()->mem_id)
                ->where('menu_id', $menu_id)
                ->delete();

        return back()->with('success', 'ลบเมนูโปรดเรียบร้อยแล้ว 🗑️');
    }
}
