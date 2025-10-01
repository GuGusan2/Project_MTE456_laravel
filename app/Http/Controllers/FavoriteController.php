<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $mem_id = Auth::guard('member')->user()->mem_id;
        $favorites = Favorite::with('menu')->where('mem_id', $mem_id)->get();
        return view('member.favorites', compact('favorites'));
    }

    public function store(Request $request)
    {
        Favorite::firstOrCreate([
            'mem_id' => Auth::guard('member')->user()->mem_id,
            'menu_id' => $request->menu_id,
        ]);

        return back()->with('success', 'เพิ่มเมนูโปรดแล้ว!');
    }

    public function destroy($menu_id)
    {
        Favorite::where('mem_id', Auth::guard('member')->user()->mem_id)
                ->where('menu_id', $menu_id)
                ->delete();

        return back()->with('success', 'ลบเมนูโปรดแล้ว!');
    }
}
