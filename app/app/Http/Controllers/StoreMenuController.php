<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\accountinfo;
use App\Models\store;
use App\Models\storeinfo;
use App\Models\storemenuinfo;
// use Request;

class StoreMenuController extends Controller
{
    public function index() {
        
        // storeidを取得仮で3
        $storeid = 3;
        // 上記のstoreidの時の店舗情報をstoreinfoのテーブルから該当行を持ってくる
        // モデル名：where('列名', '=', 検索値)->get();
        $store = storeinfo::where('storeid', '=', $storeid)->get();// 変数に代入hStore($address,$station, $storename,$comment);

        // 検索画面へ店舗情報と一緒に遷移
        return view('customers/storeMenu',[
            'store' => $store
        ]);
        
    }
    
}