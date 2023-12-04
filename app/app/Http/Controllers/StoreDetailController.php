<?php

namespace App\Http\Controllers;

use App\Models\storeinfo;
// ユーザーが各店舗の詳細をクリック後表示
class StoreDetailController extends Controller
{
    public function index() {
        
        // 
        $bookList = BookInfo::all();
        
        // 
        return view('list',[
            'bookList' => $bookList
        ]);
    }
    
}
