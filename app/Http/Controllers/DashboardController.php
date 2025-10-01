<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB; //raw sql
use App\Models\CounterModel;
use App\Models\EmployeeModel;
use App\Models\MemberModel;
use App\Models\MenuModel;
use App\Models\PromotionModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
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
        try {
            //sum price tbl_menu
            $sumPrice = MenuModel::sum('price');

            //count menu
            $countMenu = MenuModel::count();

            //count employee
            $countEmployee = EmployeeModel::count();

            //count member
            $countMember = MemberModel::count();

            //count promotion
            $countPromotion = PromotionModel::count();

            //count view
            $countView = CounterModel::count();

            //จำนวนการเข้าชมเว็ปไซต์แยกตามวัน (30 วันล่าสุด)
            $dailyVisits = DB::table('tbl_count_view')
                ->selectRaw('DATE(timestamp) as day, COUNT(*) as total')
                ->groupBy('day')
                ->orderByRaw('DATE(timestamp) DESC')
                ->limit(30)
                ->get();

            //แปลง array ไปใช้ใน chart.js
            $label = $dailyVisits->pluck('day');
            $data = $dailyVisits->pluck('total');


            return view('dashboard.index', compact('sumPrice', 'countMenu', 'countEmployee', 'countMember', 'countPromotion', 'countView', 'label', 'data'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            //  return view('errors.404');
        }
    }
} //class
