<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\regioninfo;
use App\Models\prefectureinfo;

class CustomerHomeController extends Controller
{
    public function index() {
        $regions = regioninfo::all();

        $prefectures = [];
        foreach ($regions as $region) {
            $prefectures[$region->regionid] = prefectureinfo::where('regionid', $region->regionid)->get();

        }
        // 顧客ログイン画面へ書籍情報と一緒に遷移
        return view('customers/customerHome',compact('regions', 'prefectures'));
    }
    
}