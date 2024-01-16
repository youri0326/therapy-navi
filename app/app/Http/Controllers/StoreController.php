<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\storeinfo;
use App\Models\stationinfo;
use App\Models\storephotoinfo;
use App\Models\storemenuinfo;
use Exception;

// ユーザーが各店舗の詳細をクリック後表示
class StoreController extends Controller
{
    public function search(Request $request) {
        
        //入力フォームの情報の受け取り
        
        $address = $request->query('address');
        $station = $request->query('station');
        $storename = $request->query("storename");
        $comment = $request->query("comment");

        //storeinfoモデルのインスタンス化
        $objStore = new storeinfo();

        $error = "";
        $link = [
            'href' => '',
            'text' => '',
        ];
        // 【検索データの取得】
        try {
            // 入力フォームの受け取り情報を検索値に、storeinfoテーブルから該当のデータ(店舗情報)を取得
            $storeList = $objStore->searchStore($address, $station, $storename, $comment);

        } catch (Exception $e) {
            // エラー処理
            $error = '検索に失敗しましたので、再度、ホーム場面に戻り検索してください。';
        }finally{
            if($error===""){
                // 検索画面へ店舗情報と一緒に遷移
                return view('customers/storeSearch', compact('storeList', 'address','station'));
            }else{
                $link['href'] = 'home';
                $link['text'] = 'ホーム画面に戻る';
                return view('customers/error', compact('error', 'link'));
            }
        }
        
    }
    public function detailByAdmin(Request $request) {
        
        //後々はログイン情報から取得できるようにする
        $storeid = 1;
        $store = storeinfo::with(['stationinfo', 'storephotoinfo'])->firstWhere('storeid', $storeid);// 変数に代入
        
        // 
        return view('admins/storeDetailByAdmin',[ // ひな形を指定
            'store' => $store
        ]);
    }
    public function showInsertForm()
    {
        return view('admins/showInsertForm');
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

        return view('admins/comfirmInsert', compact('data'));
    }
    // 店舗登録（管理者）を行う
    public function insert(Request $request)
    {
        // 確認画面からのデータを受け取りDBに保存する処理
        $store = storeinfo::create([ // 修正必要
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
