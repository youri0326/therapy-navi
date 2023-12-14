<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\storeinfo;
use App\Models\customerinfo;
use App\Models\reserveinfo;

// 
class ReservationController extends Controller
{
    public function storeReserveInfo(Request $request) {
        // 顧客ごとの予約情報一覧の表示
        // customeridを取得
        $customerid = $request->query('customerid');
        // 上記のcustomeridの時の予約情報をstoreinfoのテーブルから該当行を持ってくる
        // モデル名：where('列名', '=', 検索値)->get();
        $reservationList = storeinfo::where('customerid', '=', $customerid)->get();
        
        return view('customers/reservationList',[
            'reservationList' => $reservationList
        ]);
    }
}
