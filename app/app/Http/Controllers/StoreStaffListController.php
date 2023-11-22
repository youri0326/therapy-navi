<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\accountinfo;
use App\Models\storeinfo;
use App\Models\stationinfo;
use App\Models\storemenuinfo;
use App\Models\storephotoinfo;
// use Request;

class StoreStaffListController extends Controller
{
    public function index(Request $request) {
        
        $address = $request->input("address");
        $storename = $request->input("storename");
        $budget = $request->input("budget");
        $comment = $request->input("comment");

        $objStore = new storeinfo();
               
        $storeList = $objStore->searchStore($address, $storename, $budget,$comment);
        
        if (isset($storeList)) {
            foreach ($storeList as $store) {
                $stationinfo = new stationinfo();
                $storemenu = new storemenuinfo();
                $storephotoinfo = new storephotoinfo();
            }
        }

        // 検索画面へ店舗情報と一緒に遷移
        return view('customers/storeSearch',[
            'storeList' => $storeList,
        ]);

        
    }
    
}