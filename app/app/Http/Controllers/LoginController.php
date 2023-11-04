<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\accountinfo;
// use Request;

class LoginController extends Controller
{
    public function customerLogin() {
        
        // 顧客ログイン画面へ書籍情報と一緒に遷移
        return view('customers/customerLogin');
    }

    public function adminLogin() {
        
        // 管理者ログイン画面へ書籍情報と一緒に遷移
        return view('admins/adminLogin');
    }
    public function performLogin(Request $request) {
        
        $accountid = $request->input("accountid");
        $password = $request->input("password");
        $authority = $request->input("authority");
        // 一覧用の書籍情報をDBから取得
        // $accountList = accountinfo::all();
        
        // 一覧画面へ書籍情報と一緒に遷移
        if (strcmp($authority, "customer") == 0){
            return view('customers/memberDetail',[
                'accountid' => $accountid,
                'password' => $password,
            ]);
        }elseif (strcmp($authority, "admin") == 0){
            return view('admins/adminMenu',[
                'accountid' => $accountid,
                'password' => $password,
            ]);
        }
        
    }
    
}