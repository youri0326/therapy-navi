<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\accountinfo;
use App\Models\storeinfo;
use App\Models\staffinfo;
use Carbon\Carbon;

// use Request;

class AttendanceListController extends Controller
{
    public function index(Request $request)
    {
         //セッション・クッキーからログイン情報を元に、accountid⇒storeidを取得する
        // $storeid = セッションget的なものを記載するが、ログイン処理が終わってからにする
        //一旦仮でstoreid=3でテストする
        $storeid = 3;
        $month = $request->query('month');
        
        $selectedDate = null;

        // 選択された年月をCarbonインスタンスに変換
        if ($month == "lastmonth") {
            $selectedDate = Carbon::now()->addMonths(-1);
        }else if($month == "nextmonth"){
            $selectedDate = Carbon::now()->addMonths(1);
        }else{
            $selectedDate = Carbon::now();
        }

        $objStore = new storeinfo();
        // スタッフ情報と勤怠情報を取得
        $store = $objStore->getStaffAttendanceList($storeid,$selectedDate);
        // $store = storeinfo::with(['staffinfo.attendinfo' => function ($query) use ($selectedDate) {
        //     $query->whereYear('workingdate', $selectedDate->year)
        //         ->whereMonth('workingdate', $selectedDate->month);
        // }])->find($storeid);

        // 勤怠情報と一緒に遷移
        return view('/admins/attendanceList',[
            'month' => $month,
            'store' => $store,
            'selectedDate' => $selectedDate,
        ]);
    }
    
}