<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\storeinfo;
use App\Models\stationinfo;
use App\Models\storemenuinfo;
use App\Models\storephotoinfo;
// use Request;

class StoreSearchController extends Controller
{
    public function index(Request $request) {
        
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
    
}