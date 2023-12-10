<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\storeinfo;

// 
class StoreDetailController extends Controller
{
    public function storeReserveInfo() {
        // 店舗ごとの予約情報一覧の表示
        