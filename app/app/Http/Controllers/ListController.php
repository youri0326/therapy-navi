<?php

namespace App\Http\Controllers;

use App\Models\BookInfo;

class ListController extends Controller
{
    public function index() {
        
        // 一覧用の書籍情報をDBから取得
        $bookList = BookInfo::all();
        
        // 一覧画面へ書籍情報と一緒に遷移
        return view('list',[
            'bookList' => $bookList
        ]);
    }
    
}
