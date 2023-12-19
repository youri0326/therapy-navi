<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\storeinfo;
use App\Models\storemenuinfo;
use App\Models\customerinfo;
use App\Models\reserveinfo;

// 顧客IDをurlで指定
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
}
