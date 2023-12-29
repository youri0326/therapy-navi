<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\storeinfo;
// 店舗登録（管理者）を行う
class StoreDetailController extends Controller
{
    public function index() {
        // storeinfoテーブルに登録

    }

    // 登録画面
    public function create(Request $request) {
        return view('');
    }
    // 登録処理
    public function store()
}