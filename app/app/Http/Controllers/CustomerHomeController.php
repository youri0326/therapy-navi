<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class CustomerHomeController extends Controller
{
    public function index() {
        
        // 顧客ログイン画面へ書籍情報と一緒に遷移
        return view('customers/customerHome');
    }
    
}