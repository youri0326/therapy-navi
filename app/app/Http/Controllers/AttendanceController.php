<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\accountinfo;
use App\Models\storeinfo;
use App\Models\staffinfo;
use App\Models\attendinfo;
use Carbon\Carbon;

// use Request;

class AttendanceController extends Controller
{
    public function list(Request $request)
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
        $store = $objStore->getAttendanceList($storeid,$selectedDate);
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
    public function detail(Request $request)
    {
         //セッション・クッキーからログイン情報を元に、accountid⇒storeidを取得する
        // $storeid = セッションget的なものを記載するが、ログイン処理が終わってからにする
        //一旦仮でstoreid=3でテストする
        $storeid = 3;
        $staffid = $request->query('staffid');
        $month = $request->query('month');
        $year = $request->query('year');
        $selectedDate = Carbon::create($year, $month, 1);

        $objStaff = new staffinfo();
        // 該当スタッフの勤怠情報を取得
        $staff = $objStaff->getAttendanceDetailByStaff($staffid,$selectedDate);
        
        // 勤怠情報と一緒に遷移
        return view('/admins/attendanceDetailByStaff',[
            'staff' => $staff,
            'selectedDate' => $selectedDate,
        ]);
    }
    public function update(Request $request)
    {
        // リクエストからデータを取得する
        $starttime = $request->input('starttime');
        $endtime = $request->input('endtime');
        $breakstart = $request->input('breakstart');
        $breakend = $request->input('breakend');
        $workingdate = $request->input('workingdate');
        $staffid = $request->input('staffid');

        $updateAttendance = attendinfo::where('workingdate', $workingdate)->where('staffid', $staffid)->first();
        
        if ($updateAttendance) {
            // 既存情報がある場合、更新処理を行う
            $updateAttendance->starttime = $starttime;
            $updateAttendance->endtime = $endtime;
            $updateAttendance->breakstart = $breakstart;
            $updateAttendance->breakend = $breakend;
            $updateAttendance->save();
            $message = "更新:". $staffid.":".$workingdate.":".$starttime.":".":".$endtime.":".$breakstart;
            // 成功した場合、レスポンスを返す
            return response()->json(['message' => $message]);

        }else{
            // 取得したデータをデータベースに保存する
            $insertAttendance = new attendinfo();
            $insertAttendance->staffid = $staffid;
            $insertAttendance->attendance_status = '〇';
            $insertAttendance->workingdate = $workingdate;
            $insertAttendance->starttime = $starttime;
            $insertAttendance->endtime = $endtime;
            $insertAttendance->breakstart = $breakstart;
            $insertAttendance->breakend = $breakend;
            $insertAttendance->save();
            // 成功した場合、レスポンスを返す
            $message = "登録:". $staffid.":".$workingdate.":".$starttime.":".":".$endtime.":".$breakstart;
            // 成功した場合、レスポンスを返す
            return response()->json(['message' => $message]);        }
    }
}