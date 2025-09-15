<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB; //raw sql
use App\Models\CounterModel;
use App\Models\EmployeeModel;
use App\Models\MemberModel;
use App\Models\MenuModel;
use App\Models\PromotionModel;
use Carbon\Carbon;

class DashboardController extends Controller
{

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

            //จำนวนการเข้าชมเว็ปไซต์แยกตามเดือน
            $monthlyVisits = DB::table('tbl_count_view')
                ->selectRaw('DATE_FORMAT(timestamp, "%M-%Y") as ym, COUNT(*) as total')
                ->groupBy('ym')
                ->orderByRaw('DATE_FORMAT(timestamp, "%Y-%m") DESC')
                ->limit(12) // จํากัดผลลัพธ 12 แถว (12 เดือนลาสุด)
                ->get();

                //แปลง array ไปใช้ใน chart.js
                $label = $monthlyVisits -> pluck('ym');
                $data = $monthlyVisits -> pluck('total');

            return view('dashboard.index', compact('sumPrice', 'countMenu', 'countEmployee', 'countMember' ,'countPromotion' ,'countView','label' ,'data'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            //  return view('errors.404');
        }
    }
} //class
