<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\LoginController;

//顧客側のインポート
use App\Http\Controllers\CustomerHomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//　トップページ
Route::get('/', function () {
    return view('menu');
});

// 一覧表示
Route::get('/list', [ListController::class,'index']);

//login機能
// Route::resource('common/login', 'common/LoginController@performLogin');

Route::get('/common/login', [LoginController::class,'performLogin']);
Route::post('/common/login', [LoginController::class,'performLogin']);
Route::get('/customers/login', [LoginController::class,'customerLogin']);
Route::get('/admins/login', [LoginController::class,'adminLogin']);

/*
顧客機能系
*/
// ホーム画面
Route::get('/', [CustomerHomeController::class,'index']);

//検索機能
Route::get('/customers/storeSearch', [StoreSearchController::class,'index']);

/*
管理者機能
*/