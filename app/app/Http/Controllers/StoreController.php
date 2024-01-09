<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\storeinfo;
use App\Models\stationinfo;
use App\Models\storephotoinfo;
use App\Models\storemenuinfo;

// ユーザーが各店舗の詳細をクリック後表示
class StoreController extends Controller
{
    public function search(Request $request) {
        
        //入力フォームの情報の受け取り
        $address = $request->query('address');
        $station = $request->query('station');
        $storename = $request->query("storename");
        $comment = $request->query("comment");

        //storeinfoモデルのインスタンス化
        $objStore = new storeinfo();
        
        // 【検索データの取得】
        // 入力フォームの受け取り情報を検索値に、storeinfoテーブルから次のテーブルを結合(joinする形で)該当する行を取得        
        $storeList = $objStore->searchStore($address,$station, $storename,$comment);
        
        // 検索画面へ店舗情報と一緒に遷移
        return view('customers/storeSearch',[
            'storeList' => $storeList,
            'address' => $address,
            'station' => $station,
        ]);
        
    }
    public function detailByAdmin(Request $request) {
        
        //後々はログイン情報から取得できるようにする
        $storeid = 1;
        $store = storeinfo::with(['stationinfo', 'storephotoinfo'])->firstWhere('storeid', $storeid);// 変数に代入
        
        // 
        return view('admins/storeDetailByAdmin',[ // ひな形を指定
            'store' => $store
        ]);
    }
    
}
