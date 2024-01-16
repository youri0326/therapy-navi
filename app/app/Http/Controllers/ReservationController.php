<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\accountinfo;
use App\Models\storeinfo;
use App\Models\staffinfo;
use App\Models\attendinfo;
use App\Models\customerinfo;
use App\Models\reserveinfo;
use App\Models\storemenuinfo;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function reservationList(Request $request) {
        // 顧客ごとの予約情報一覧の表示
        // customeridを取得
        $customerid = $request->query('customerid');
        // $customerid = 1; デバッグ用
        // 上記のcustomeridの時の予約情報をreserveinfoのテーブルから該当行を持ってくる
        // モデル名：where('列名', '=', 検索値)->get();
        $reservationList = reserveinfo::where('customerid', '=', $customerid)->get();
        // 顧客のレコードを取得
        $customerList = customerinfo::find($customerid);
        // 店舗メニューリストを取得
        $storemenuList = storemenuinfo::all();
        // 店舗リストを取得
        $storeList = storeinfo::all();

        return view('customers/reservationList',[
            'reservationList' => $reservationList,
            'customerList' => $customerList,
            'storemenuList' => $storemenuList, 
            'storeList' => $storeList
        ]);
    }

    public function showReservationForm(Request $request)
    {
         //セッション・クッキーからログイン情報を元に、accountid⇒storeidを取得する
        // $storeid = セッションget的なものを記載するが、ログイン処理が終わってからにする
        //一旦仮でstoreid=3でテストする
        $customerid = 3;
        $storemenuid = 2;
        $storeid = 3;
        $staff = null;
        if ($request->has('staffid')) {
            // 特定のスタッフが選択されている場合
            // $staff = $storeinfo->staffinfo->firstWhere('staffid', $request->input('staffid'));
            $staff = staffinfo::firstWhere('staffid', $request->input('staffid'));

        }
        // // 予約フォーム表示のロジック
        // $storeinfo = storeinfo::with('staffinfo', 'staffinfo.attendinfo', 'staffinfo.reserveinfo')->findOrFail($storeid);
        //店舗情報の取得
        $storemenuinfo = storemenuinfo::with('storeinfo')->findOrFail($storemenuid);
        // $storemenuinfo = storemenuinfo::with('storeinfo')->where('storemenuid','=',$storemenuid);
        $storeinfo = $storemenuinfo->storeinfo->first();

        // //test
        // // $store = storemenuinfo::with('storeinfo','storeinfo.staffinfo')->where('storemenuid','=',2)->storeinfo;
        // $store = storemenuinfo::with('storeinfo','storeinfo.staffinfo')->where('storemenuid','=',2);
        // $store = $storemenu->storeinfo;        

        $dates = collect();
        for ($i = 0; $i < 7; $i++) {
            $dates->push(Carbon::today()->addDays($i));
        }

        $availability = collect();
        foreach ($dates as $date) {
            $dailyAvailability = collect();
            for ($hour = 9; $hour <= 22; $hour++) {
                $timeSlot = Carbon::parse($date)->setHour($hour);

                if ($request->has('staffid')) {
                    // 特定のスタッフが選択されている場合
                    // $staff = $storeinfo->staffinfo->firstWhere('staffid', $request->input('staffid'));
                    $staff = staffinfo::firstWhere('staffid', $request->input('staffid'));
                    $isAvailable = $this->checkAvailabilityForStaff($staff, $timeSlot);

                } else {
                    // スタッフが選択されていない場合
                    $isAvailable = $this->checkAvailability($storeinfo, $timeSlot);
                }

                $dailyAvailability->put($hour, $isAvailable);
            }
            $availability->put($date->format('Y-m-d'), $dailyAvailability);
        }

        return view('customers.reservation', compact('storeinfo', 'availability', 'dates','storemenuinfo','staff'));
    }

    public function confirmReservation(Request $request)
    {
        // 予約確認のロジック
        $storemenuid = $request->input('storemenuid');
        $storeid = $request->input('storeid');
        $reservation_datetime = $request->input('reservation_datetime');
        $storeinfo = storeinfo::firstWhere('storeid',$storeid);
        $storemenuinfo = storemenuinfo::firstWhere('storemenuid',$storemenuid);
        $staff = null;
        if ($request->has('staffid')) {
            // 特定のスタッフが選択されている場合
            $staff = staffinfo::firstWhere('staffid', $request->input('staffid'));
        }

        return view('customers.reservationConfirmation', compact('storeinfo', 'reservation_datetime','storemenuinfo','staff'));
    }

    public function storeReservation(Request $request)
    {
         //セッション・クッキーからログイン情報を元に、accountid⇒storeidを取得する
        // $storeid = セッションget的なものを記載するが、ログイン処理が終わってからにする
        //一旦仮でstoreid=3でテストする
        $customerid = 3;
        // $reservationData = $request->all();
        $storemenuid = $request->input('storemenuid');
        $storeid = $request->input('storeid');
        $addcomment =$request->input('addcomment');
        $reservation_datetime = $request->input('reservation_datetime');
        $reservation_datetime = Carbon::parse($reservation_datetime);
        $reservedate = $reservation_datetime->format('Y-m-d');
        $reservetime = $reservation_datetime->format('H:i');
        $storeinfo = storeinfo::firstWhere('storeid',$storeid);
        $storemenuinfo = storemenuinfo::firstWhere('storemenuid',$storemenuid);
        $staffid = null;
        $staff = null;
        if ($request->has('staffid')) {
            // 特定のスタッフが選択されている場合
            $staffid = $request->input('staffid');
            $staff = staffinfo::firstWhere('staffid', $staffid);
        }else{
            // $storeinfo = storeinfo::findOrFail($storeid);
            $staff = $storeinfo->staffinfo->random();
            $staffid = $staff->staffid;
        }
        $reservationData = array(
            'customerid'=> $customerid, 
            'storemenuid'=> $storemenuid,
            'staffid'=> $staffid,
            'reservedate'=> $reservedate, 
            'reservetime'=> $reservetime,
            // 'payment'=>'なし',
            // 'status'=>'りんご', 
            'addcomment'=> $addcomment
        );
        
        $reservation = new reserveinfo($reservationData);

        //予約登録の成功・失敗の判定内容を格納する変数
        //成功の場合：1、失敗の場合：0
        $saveStatus = 0;
        if($reservation->save()){
            $saveStatus = 1;
        }

        return view('customers.reservationDone', compact('storeinfo', 'reservation_datetime','storemenuinfo','staff','addcomment','saveStatus'));
    }

    //$storeinfo 各スタッフの情報が必要 または選択されたスタッフの情報
    private function checkAvailability($storeinfo, $timeSlot)
    {
        foreach ($storeinfo->staffinfo as $staff) {
            // $attend = $staff->attendinfo->first(function ($attend) use ($timeSlot) {
            //     // 休憩時間を考慮した勤務時間の判定
            //     $workStart = Carbon::parse($attend->starttime);
            //     $workEnd = Carbon::parse($attend->endtime);
            //     $breakStart = Carbon::parse($attend->breakstart);
            //     $breakEnd = Carbon::parse($attend->breakend);

            //     return $attend->workingdate == $timeSlot->format('Y-m-d') &&
            //            $timeSlot->between($workStart, $workEnd) &&
            //            (!$timeSlot->between($breakStart, $breakEnd));
            // });
            // スタッフの勤怠情報を確認
            $attendList = $staff->attendinfo;
            $attendJudge = function ($attendList) use ($timeSlot) {
                $attend = $attendList->where('workingdate',$timeSlot->format('Y-m-d'))->first();
                if($attend === null){
                    return false;
                }
                // 休憩時間を考慮した勤務時間の判定
                $workStart = Carbon::parse($attend->workingdate . ' ' . $attend->starttime);
                $workEnd = Carbon::parse($attend->workingdate . ' ' . $attend->endtime);
                $breakStart = Carbon::parse($attend->workingdate . ' ' . $attend->breakstart);
                // $breakEnd = Carbon::parse($attend->workingdate . ' ' . $attend->breakend);

                return $timeSlot->between($workStart, $workEnd) &&
                        (!$timeSlot->eq($breakStart));
            };
            $attend = $attendJudge($attendList);
                
            // 予約情報を確認
            //timeslot 日時＋ 時間
            //各予約時間が、timeslotが含まれていないか
            //予約開始時間 > timeslot >予約終了時間 ⇒false

            // $reserved = $staff->reserveinfo->contains(function ($reservation) use ($timeSlot) {
            //     $reservedTime = Carbon::parse($reservation->reservedate . ' ' . $reservation->reservetime);
            //     $serviceDuration = storemenuinfo::find($reservation->storemenuid)->servicetime;
            //     $serviceEnd = $reservedTime->copy()->addMinutes($serviceDuration);

            //     return $reservedTime->lte($timeSlot) && $serviceEnd->gt($timeSlot);
            //     // return $reservation->reservedate == $timeSlot->format('Y-m-d') &&
            //     //        Carbon::parse($reservation->reservetime)->equalTo($timeSlot);
            // });

            // $reserved = $staff->reserveinfo(function ($reservations) use ($timeSlot) {
            //     $reserveJudge = false;
            //     foreach ($reservations as $reservation){
            //         $reservedTime = Carbon::parse($reservation->reservedate . ' ' . $reservation->reservetime);
            //         $serviceDuration = storemenuinfo::find($reservation->storemenuid)->servicetime;
            //         $serviceEnd = $reservedTime->copy()->addMinutes($serviceDuration);
            //         $reserveJudge = $reservedTime->lte($timeSlot) && $serviceEnd->gt($timeSlot);
            //         if($reserveJudge){
            //             return $reserveJudge;
            //         } 
            //     }
            //     return $reserveJudge;
            // });
            $reservations = $staff->reserveinfo;
            $reserveJudge = function ($reservations) use ($timeSlot) {
                $reserveJudge = false;
                foreach ($reservations as $reservation){
                    $reservedTime = Carbon::parse($reservation->reservedate . ' ' . $reservation->reservetime);
                    $serviceDuration = storemenuinfo::find($reservation->storemenuid)->servicetime;
                    $serviceEnd = $reservedTime->copy()->addMinutes($serviceDuration);
                    $reserveJudge = $reservedTime->lte($timeSlot) && $serviceEnd->gt($timeSlot);
                    if($reserveJudge){
                        return $reserveJudge;
                    } 
                }
                return $reserveJudge;
            };
            $reserved = $reserveJudge($reservations);
    
            if ($attend && !$reserved) {
                // 勤務していて、かつ予約がない場合は予約可能
                return true;
            }
        }
        return false; // すべてのスタッフが予約できない場合は予約不可
    }

    //$storeinfo 各スタッフの情報が必要 または選択されたスタッフの情報
    private function checkAvailabilityForStaff($staff, $timeSlot)
    {
        // $attend = $staff->attendinfo(function ($attend) use ($timeSlot) {
        //     $attend->where('workingdate',$timeSlot->format('Y-m-d'))->first();
        //     // 休憩時間を考慮した勤務時間の判定
        //     $workStart = Carbon::parse($attend->starttime);
        //     $workEnd = Carbon::parse($attend->endtime);
        //     $breakStart = Carbon::parse($attend->breakstart);
        //     $breakEnd = Carbon::parse($attend->breakend);

        //     return $attend->workingdate == $timeSlot->format('Y-m-d') &&
        //             $timeSlot->between($workStart, $workEnd) &&
        //             (!$timeSlot->between($breakStart, $breakEnd));

        // });

        // スタッフの勤怠情報を確認
        $attendList = $staff->attendinfo;
        $attendJudge = function ($attendList) use ($timeSlot) {
            $attend = $attendList->where('workingdate',$timeSlot->format('Y-m-d'))->first();
            if($attend === null){
                return false;
            }
            // 休憩時間を考慮した勤務時間の判定
            $workStart = Carbon::parse($attend->workingdate . ' ' . $attend->starttime);
            $workEnd = Carbon::parse($attend->workingdate . ' ' . $attend->endtime);
            $breakStart = Carbon::parse($attend->workingdate . ' ' . $attend->breakstart);
            // $breakEnd = Carbon::parse($attend->workingdate . ' ' . $attend->breakend);

            return $timeSlot->between($workStart, $workEnd) &&
                    (!$timeSlot->eq($breakStart));
        };
        $attend = $attendJudge($attendList);
        // 予約情報を確認
        // $reserved = $staff->reserveinfo->contains(function ($reservation) use ($timeSlot) {
        //     $reservedTime = Carbon::parse($reservation->reservedate . ' ' . $reservation->reservetime);
        //     $serviceDuration = storemenuinfo::find($reservation->storemenuid)->servicetime;
        //     $serviceEnd = $reservedTime->copy()->addMinutes($serviceDuration);

        //     return $reservedTime->lte($timeSlot) && $serviceEnd->gt($timeSlot);
        //  });
        $reservations = $staff->reserveinfo;
        $reserveJudge = function ($reservations) use ($timeSlot) {
            $reserveJudge = false;
            foreach ($reservations as $reservation){
                $reservedTime = Carbon::parse($reservation->reservedate . ' ' . $reservation->reservetime);
                $serviceDuration = storemenuinfo::find($reservation->storemenuid)->servicetime;
                $serviceEnd = $reservedTime->copy()->addMinutes($serviceDuration);
                $reserveJudge = $reservedTime->lte($timeSlot) && $serviceEnd->gt($timeSlot);
                if($reserveJudge){
                    return $reserveJudge;
                } 
            }
            return $reserveJudge;
        };
        $reserved = $reserveJudge($reservations);
        if ($attend && !$reserved) {        
        // if ($attend) {
            // 勤務していて、かつ予約がない場合は予約可能
            return true;
        }
        return false; // すべてのスタッフが予約できない場合は予約不可
    }

    // ...その他のメソッド...
    public function insert(Request $request)
    {
         //セッション・クッキーからログイン情報を元に、accountid⇒storeidを取得する
        // $storeid = セッションget的なものを記載するが、ログイン処理が終わってからにする
        //一旦仮でstoreid=3でテストする
        // $customerid = 3;

        // $storeid = 3;
        
        // // 特定の店舗の情報を取得（IDが3の店舗）
        // $storeinfo = storeinfo::with('staffinfo', 'staffinfo.attendinfo')->findOrFail($storeid);
    
        // // 予約情報がある場合、確認画面へ
        // if ($request->has('reservation')) {
        //     $reservationData = $request->input('reservation');
        //     // 予約情報をデータベースに保存
        //     // ... 保存処理 ...
        //     return view('/customers/reservationConfirmation',[
        //         'reservationData' => $reservationData,
        //     ]);
        // } else {
        //     $attendinfo = collect();

        //     // スタッフ情報がある場合の処理
        //     if ($request->has('staffid')) {
        //         $staffid = $request->input('staffid');
        //         $attendinfo = $storeinfo->staffinfo->firstWhere('staffid', $staffid)->attendinfo
        //                         ->where('workingdate', '>=', Carbon::today())
        //                         ->where('workingdate', '<=', Carbon::today()->addDays(7));
        //     } else {
        //         // スタッフ情報がない場合、店舗に関連する全従業員の出勤情報を取得
        //         foreach ($storeinfo->staffinfo as $staff) {
        //             $attendinfo = $attendinfo->merge($staff->attendinfo
        //                             ->where('workingdate', '>=', Carbon::today())
        //                             ->where('workingdate', '<=', Carbon::today()->addDays(7)));
        //         }
        //     }
        //     return view('/customers/reservationConfirmation',[
        //         'storeinfo' => $storeinfo,
        //         'attendinfo' => $attendinfo,
        //     ]);
        // }
    }

    public function reservationListAdmin(Request $request) {
        // 店舗IDを取得
        $storeid = 2;

        // 指定した店舗IDに対応する予約情報を取得
        $reservationList = reserveinfo::whereHas('storemenuinfo.storeinfo', function ($query) use ($storeid) {
            $query->where('storeid', $storeid);
        })->get();
        // 対象の店舗を取得
        $storeList = storeinfo::where('storeid', '=', $storeid)->get();
        // 対象の店舗のメニューリストを取得
        $storemenuList = storemenuinfo::where('storeid', '=', $storeid)->get();
        // 顧客のレコードを取得
        // $customerList = customerinfo::find($customerid);

        return view('admins/reservationList',[
            'reservationList' => $reservationList,
            'storemenuList' => $storemenuList, 
            'storeList' => $storeList
        ]);
    }
}

