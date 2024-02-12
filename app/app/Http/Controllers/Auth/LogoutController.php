<?php

namespace App\Http\Controllers\Auth;
// use Illuminate\Http\Controller;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    /**
     * ログアウト処理を行う
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();


        $pathInfo = $request->path();
        if (str_starts_with($pathInfo, 'admins/')) {
            return redirect()->route('admin.login');
        } else {
            return redirect()->route('customer.login');
           
        }
    }
}