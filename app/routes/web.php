<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\LoginController;

//顧客側のインポート
use App\Http\Controllers\CustomerHomeController;
use App\Http\Controllers\StoreSearchController;

use App\Http\Controllers\StoreStaffListController;
use App\Http\Controllers\StoreDetailController;
use App\Http\Controllers\StoreMenuController;
use App\Http\Controllers\ReservationController;


//管理者側のインポート
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\StoreInsertController;

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
//店舗スタッフ一覧
Route::get('/customers/storeStaffList', [StoreStaffListController::class,'index']);
//検索機能
Route::get('/customers/storeSearch', [StoreSearchController::class,'index']);
//店舗詳細機能
Route::get('/customers/storeDetail', [StoreDetailController::class,'index']);
//店舗メニュー一覧機能
Route::get('/customers/storeMenu', [StoreMenuController::class,'index']);

/*
顧客 予約関連 機能
*/
//予約一覧表示機能
Route::get('/customers/reservationList', [ReservationController::class,'reservationList']);

//予約機能：予約フォーム表示
Route::get('/customers/reservation/showForm', [ReservationController::class,'showReservationForm']);

//予約機能：予約情報確認
Route::post('/customers/reservation/confrim', [ReservationController::class,'confirmReservation']);

//予約機能：予約登録完了
Route::post('/customers/reservation/insert', [ReservationController::class,'storeReservation']);

/*
管理者機能
*/

//勤怠情報一覧表示
Route::get('/admins/attendanceList', [AttendanceController::class,'list']);
Route::get('/admins/attendanceDetail', [AttendanceController::class,'detail']);
Route::post('/admins/update', [AttendanceController::class,'update'])->name('admins.update');

//店舗登録機能
Route::get('/admins/store/insertForm', [StoreController::class, 'showInsertForm']);
Route::post('/admins/store/confirm', 'StoreController@confirm')->name('store.confirm');