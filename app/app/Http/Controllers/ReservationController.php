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
    public function showReservationForm(Request $request)
    {
         //セッション・クッキーからログイン情報を元に、accountid⇒storeidを取得する
        // $storeid = セッションget的なものを記載するが、ログイン処理が終わってからにする
        //一旦仮でstoreid=3でテストする
        $customerid = 3;
        $storemenuid = 8;
        $storeid = 3;

        // // 予約フォーム表示のロジック
        // $storeinfo = storeinfo::with('staffinfo', 'staffinfo.attendinfo', 'staffinfo.reservationinfo')->findOrFail($storeid);
        $storemenuinfo = storemenuinfo::with('storeinfo')->findOrFail($storemenuid);
        $storeinfo = $storemenuinfo->storeinfo;


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
                    $staff = $storeinfo->staffinfo->firstWhere('staffid', $request->input('staffid'));
                    $isAvailable = $this->checkAvailabilityForStaff($staff, $timeSlot);
                } else {
                    // スタッフが選択されていない場合
                    $isAvailable = $this->checkAvailability($storeinfo, $timeSlot);
                }

                $dailyAvailability->put($hour, $isAvailable);
            }
            $availability->put($date->format('Y-m-d'), $dailyAvailability);
        }

        return view('customers.reservation', compact('storeinfo', 'availability', 'dates','storemenuinfo'));
    }

    public function confirmReservation(Request $request)
    {
        // 予約確認のロジック
        $reservationData = $request->all();
        return view('customers.reservationConfirmation', compact('reservationData'));
    }

    public function storeReservation(Request $request)
    {
         //セッション・クッキーからログイン情報を元に、accountid⇒storeidを取得する
        // $storeid = セッションget的なものを記載するが、ログイン処理が終わってからにする
        //一旦仮でstoreid=3でテストする
        $customerid = 3;

        $storeid = 3;
        // 予約登録のロジック
        $reservationData = $request->all();

        if (empty($reservationData['staffid'])) {
            $storeinfo = storeinfo::findOrFail($storeid);
            $staff = $storeinfo->staffinfo->random();
            $reservationData['staffid'] = $staff->staffid;
        }

        $reservation = new reserveinfo($reservationData);
        $reservation->save();

        return redirect()->route('reservation.success');
    }

    private function checkAvailability($storeinfo, $timeSlot)
    {
        foreach ($storeinfo->staffinfo as $staff) {
            // スタッフの勤怠情報を確認
            $attend = $staff->attendinfo->first(function ($attend) use ($timeSlot) {
                return $attend->workingdate == $timeSlot->format('Y-m-d') &&
                       $timeSlot->between(
                           Carbon::parse($attend->starttime),
                           Carbon::parse($attend->endtime)
                       );
            });

            // 予約情報を確認
            $reserved = $staff->reservationinfo->any(function ($reservation) use ($timeSlot) {
                $reservedTime = Carbon::parse($reservation->reservedate . ' ' . $reservation->reservetime);
                $serviceDuration = storemenuinfo::find($reservation->storemenuid)->servicetime;
                $serviceEnd = $reservedTime->copy()->addMinutes($serviceDuration);

                return $reservedTime->lte($timeSlot) && $serviceEnd->gt($timeSlot);
                // return $reservation->reservedate == $timeSlot->format('Y-m-d') &&
                //        Carbon::parse($reservation->reservetime)->equalTo($timeSlot);
            });
            
            if ($attend && !$reserved) {
                // 勤務していて、かつ予約がない場合は予約可能
                return true;
            }
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

}