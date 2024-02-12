<?php

namespace App\Http\Controllers\Auth;
// use Illuminate\Http\Controller;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\accountinfo;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Support\Facades\Auth;

// use Request;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function logintest() {
        
        // 顧客ログイン画面へ書籍情報と一緒に遷移
        return view('common/commonLoginTest');
    }
    public function customerLogin() {
        
        // 顧客ログイン画面へ書籍情報と一緒に遷移
        return view('customers/customerLogin');
    }
    public function adminLogin() {
        
        // 管理者ログイン画面へ書籍情報と一緒に遷移
        return view('admins/adminLogin');
    }
    /**
     * @param  App\Http\Requests\LoginFormRequest
     * $request
     */
    public function performLogin(LoginFormRequest $request) {

        $formDatas = $request->only("loginid","password","authority");
        $error = "";

        //認証の可否を判定
        if(Auth::attempt($formDatas)){
            $request->session()->regenerate();
            $request->session()->put('csrf_token', csrf_token());
        }else{
            $error = "ログインIDかパスワードが間違っています。";
        }

        //遷移先のパス情報の取得
        $redirectPath = "";
        if($formDatas["authority"]==="0"){
            $redirectPath = '/';
            // $redirectPath = 'logintest';
        }else{
            $redirectPath = '/admins/store/detail';
        }

        //遷移処理
        // if($error===""){
        //     return redirect($redirectPath)->with('login_success', function () {
        //         return 'ログインが成功しました。';
        //     });
        // }

        if($error===""){
            return redirect($redirectPath)->with('login_success', 'ログインが成功しました。');
        }else{
            return back()->withErrors([
                'login_error' => 'ログインIDかパスワードが間違っています。',
            ]);
        }
        
        // $loginid = $request->input("loginid");
        // $password = $request->input("password");
        // $authority = $request->input("authority");
        // // 一覧用の書籍情報をDBから取得
        // // $accountList = accountinfo::all();
        
        // // 一覧画面へ書籍情報と一緒に遷移
        // if (strcmp($authority, "customer") == 0){
        //     return view('customers/memberDetail',[
        //         'loginid' => $loginid,
        //         'password' => $password,
        //     ]);
        // }elseif (strcmp($authority, "admin") == 0){
        //     return view('admins/adminMenu',[
        //         'loginid' => $loginid,
        //         'password' => $password,
        //     ]);
        // }
        
    }
    /**
     * ログアウト処理を行う
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function customerLogout()
    {
        Auth::logout();

        return redirect('/');
    }
}