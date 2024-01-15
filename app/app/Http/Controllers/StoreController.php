<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\storeinfo;
use App\Models\stationinfo;
use App\Models\storephotoinfo;
use App\Models\storemenuinfo;
use Exception;
use Illuminate\Support\Facades\Validator;


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

    /* 
     写真登録機能
     ・登録画面表示:showPhotoFormメソッド
     ・登録機能 :storePhotoメソッド
    */
    public function showPhotoForm(Request $request)
    {
        $error = "";
        $link = [
            'href' => '',
            'text' => '',
        ];
        $store = null;

        try{
            // 店舗情報の取得
            // $storeid = $request->storeid;
            $storeid = 2;
            $store = storeinfo::with(['stationinfo', 'storephotoinfo'])->firstWhere('storeid', $storeid);

        } catch (Exception $e) {
            $link = [
                'href' => 'admins.store.photo.showform',
                'text' => '店舗写真登録フォーム',
            ];
            $error = 'データベースのエラーが発生しました、再入力してください。';

        }finally{
            //DB関連のエラーが発生する場合の遷移先
            if($error === ""){
                return view('admins/store_photos/showForm', compact('store'));
            }
            else{
                //ホームに移動
                return view('customers/error', compact('error', 'link'));
            }
        }
    }


    public function storePhoto(Request $request)
    {
        $error = "";
        $dbErrorJudge = false;
        $store = null;
        $link = [
            'href' => '',
            'text' => '',
        ];
        $message = '';
        try{
            // フォームからの送信がある場合
            if ($request->isMethod('post')) {
                // バリデーション

                $rules = [
                    'photo_01' => 'required|image|max:2048',
                    'subphoto1' => 'required|image|max:2048',
                    'subphoto2' => 'required|image|max:2048',
                ];
                $validator = Validator::make($request->all(), $rules);

                //バリデーションに失敗した場合
                if ($request->$validator->fails()) {
                    // 登録フォームに戻る
                    $error = 'エラーが発生しました、再アップロードしてください。';
                    return;
                }
                /*
                ファイルの保存
                */

                $photoList = [new storephotoinfo(),new storephotoinfo(),new storephotoinfo()];
                $photoDir = 'public/img/storephoto';

                for ($i = 0; $i < 3; $i++) {
                    //name属性の値の取得
                    $name_field = 'photo_'.$i;
                    //ファイル情報の取得
                    $photoname = $request->file($name_field);
                    //ファイルのパスの取得
                    $photopath = $photoDir.'/'.$photoname;
                    //画像のアップロード
                    $photoname->store($photoDir);

                    //モデルズにDBへの登録情報を格納
                    $photo = $photoList[$i];
                    $photo->storeid = $request->storeid;
                    $photo->photopath = $photopath;
                    $photo->imgrole = $i;
                    $photo->save();
                }

                // 成功メッセージ
                $message = '店舗写真を追加・更新しました。';
            }

            // フォームからの送信がない場合、Finnally句に移動して登録フォームに遷移
            else {
                $error = 'エラーが発生しました、再アップロードしてください。';
                return;
            }
        } catch (Exception $e) {
            // エラー処理
            $error = 'エラーが発生しました、再アップロードしてください。';

        }finally{
            //アップロード処理が上手くいった際の遷移先
            if($error === ""){
                // JSON 形式でレスポンスを返す
                return response()->json(['message' => $message]);
            }else{
                return redirect()->route('admins/store_photos/showForm')->with(compact('error'));
            }
        }
    }


}
