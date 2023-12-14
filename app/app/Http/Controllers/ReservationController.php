<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\storeinfo;
use App\Models\reserveinfo;

// 
class StoreDetailController extends Controller
{
    public function storeReserveInfo() {
        // 店舗ごとの予約情報一覧の表示
        $reservationList = reserveinfo::all();
        
        return view('customers/reservationList',[
            'reservationList' => $reservationList
        ]);
    }
}
