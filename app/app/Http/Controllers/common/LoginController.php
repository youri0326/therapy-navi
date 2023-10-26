<?php

namespace App\Http\Controllers;

use App\Models\accountinfo;

class LoginController extends Controller
{
    public function performLogin() {
        
        // 一覧用の書籍情報をDBから取得
        $accountList = accountinfo::all();
        
        // 一覧画面へ書籍情報と一緒に遷移
        return view('customers/customerLogin',[
            '$accountinfo' => $accountList
        ]);
    }
    
}