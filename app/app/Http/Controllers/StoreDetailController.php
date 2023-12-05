<?php

namespace App\Http\Controllers;

use App\Models\storeinfo;
// ユーザーが各店舗の詳細をクリック後表示
class StoreDetailController extends Controller
{
    public function index() {
        
        // storeidを取得仮で3
        $storeid=3;
        // 上記のstoreidの時の店舗情報をstoreinfoのテーブルから該当行を持ってくる
        // モデル名：where('列名', '=', 検索値)->get();
        storeinfo::where('storeid', '=', $storeid)->get();
        
        // 
        return view('store',[
            'store' => $storeid
        ]);
    }
    
}
