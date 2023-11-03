<?php

namespace App\Http\Controllers;

use App\Models\accountinfo;
use Request;

class LoginController extends Controller
{
    public function customersLogin() {
        
        // 顧客ログイン画面へ書籍情報と一緒に遷移
        return view('customers/customerLogin');
    }

    public function adminLogin() {
        
        // 管理者ログイン画面へ書籍情報と一緒に遷移
        return view('admins/customerLogin');
    }
    public function performLogin(Request $request) {
        
        $accountid = $request->input("accountid");
        $password = $request->input("password");
        // 一覧用の書籍情報をDBから取得
        // $accountList = accountinfo::all();
        
        // 一覧画面へ書籍情報と一緒に遷移
        return view('customers/customerLogin',[
            'accountid' => $accountid
        ]);
    }
    
}