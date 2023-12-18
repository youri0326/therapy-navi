<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\storeinfo;
use App\Models\customerinfo;
use App\Models\reserveinfo;

// 顧客IDをurlで指定
class ReservationController extends Controller
{
    public function reservationList(Request $request) {
        // 顧客ごとの予約情報一覧の表示
        // customeridを取得
        // $customerid = $request->query('customerid');
        $customerid = 1;
        // 上記のcustomeridの時の予約情報をreserveinfoのテーブルから該当行を持ってくる
        // モデル名：where('列名', '=', 検索値)->get();
        $reservationList = reserveinfo::where('customerid', '=', $customerid)->get();
        // 顧客のレコードを取得
        $customerList = customerinfo::find($customerid);
        // 予約情報から対応する店舗のstoreidを取得
        $storeList = storemenuinfo::find($reservationList->pluck('storemenuinfo.storeinfo.storeid')->unique());
        // 対応する店舗の情報を取得
        $storesList = storeinfo::whereIn('storeid', $storeIds)->get();

        return view('customers/reservationList',[
            'reservationList' => $reservationList,
            'customerList' => $customerList,
            'storeList' => $storesList
        ]);
    }
}
