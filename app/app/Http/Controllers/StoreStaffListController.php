<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\staffinfo;
// use Request;

class StoreStaffListController extends Controller
{
    public function index() {
        // 
        $staffList = staffinfo::all();
        
        return view('customers/storeStaffList',[
            'staffList' => $staffList
        ]);
        
    }
    
}