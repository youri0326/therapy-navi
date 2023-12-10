<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\storeinfo;

// ユーザーが各店舗の詳細をクリック後表示
class StoreDetailController extends Controller
{
    public function index(Request $request) {
        
        // URLからstoreidを取得
        $storeid = $request->query('storeid');
        // 上記のstoreidの時の店舗情報をstoreinfoのテーブルから該当行を持ってくる
        // モデル名：where('列名', '=', 検索値)->get();
        $store = storeinfo::where('storeid', '=', $storeid)->get();// 変数に代入
        
        // 
        return view('customers/storeDetail',[ // ひな形を指定
            'store' => $store
        ]);
    }
    
}
