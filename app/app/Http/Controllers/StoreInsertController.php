<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\storeinfo;
// 店舗登録（管理者）を行う
class StoreInsertController extends Controller
{
    public function showInsertForm()
    {
        return view('admins/storeInsert');
    }

    public function confirmInsert(Request $request)
    {
        // 入力値を取得して確認画面に渡す処理を記述
        $data = $request->validate([
            'storename' => 'required',
            'address' => 'required',
            'budget' => 'required',
            'comment' => 'required',
            'payment' => 'required'
            // 他のフォームフィールドもここに追加
        ]);

        return view('admins/storeInsertConfirm', compact('data'));
    }

    public function insert(Request $request)
    {
        // 確認画面からのデータを受け取りDBに保存する処理
        $store = Store::create([
            'storename' => $request->storename,
            'address' => $request->address,
            'budget' => $request->budget,
            'comment' => $request->comment,
            'payment' => $request->payment
            // 他のフォームフィールドもここに追加
        ]);

        // 登録処理後にリダイレクトする
        return redirect()->route('storemenuinfo'); // 仮に名前付きルート "storemenuinfo" を使用
    }
}