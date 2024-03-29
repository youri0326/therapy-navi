<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\storeinfo;
use App\Models\stationinfo;
use App\Models\storephotoinfo;
use App\Models\storemenuinfo;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


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
            $storeid = 1;
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
    public function insert(Request $request)
    {
        $error = "";
        $message = '';
        $storeid = 1; 
        // $s = $request->hasFile('photo_0');
        // info('変数の中身: ' . print_r($s, true));
        // dd($s);


        try{
            // バリデーション

            $rules = [
                'photo' => 'image|max:2048',
            ];

            // $validator = Validator::make($requestList, $rules);
            // //バリデーションに失敗した場合
            // if ($validator->fails()) {
            //     // 登録フォームに戻る
            //     $error = 'エラーが発生しました、再アップロードしてください。';
            //     return;
            // }
            /*
            ファイルの保存
            */
            $uploadDir = 'public/img/storephoto/';
            $photoDir = 'storage/img/storephoto/';

            $imgrole = (int)$request->input('imgrole');

            // ファイルフィールドの判定
            // if (!$request->hasFile('photo')) {
            //     $message = $message."アップロードなし.";
            //     return;
            // }
            $photoData = $request->file('photo');
            
            /*
                ファイル名の取得
            */
            // ファイル名を取得
            $photoname = $photoData->getClientOriginalName();
            $message = $message.$photoname;

            // 拡張子の取得
            $extension = $photoData->getClientOriginalExtension();

            //拡張子を除いたファイル名の取得
            $photoname = substr($photoname, 0, -strlen(".".$extension));

            //日付・拡張子を含むファイル名を生成
            $photoname = $photoname . '-' . time() . '.' . $extension;

            //ファイルのパスの取得
            $photopath = $photoDir.$photoname;

            //画像のアップロード
            $photoData->storeAs($uploadDir,$photoname);

            //モデルズにDBへの登録情報を格納
            $photoObj = storephotoinfo::where('storeid', $storeid)->where('imgrole', $imgrole)->first();
            
            /*
            検索情報の有無を確認します。
                ①情報が確認できなければ新規登録、
                ②できれば更新処理
            */
            if (!$photoObj) {
                // 新規登録の場合の処理
                $photoObj = new storephotoinfo();
                $photoObj->storeid = $storeid;
                $photoObj->imgrole = $imgrole;
            }
            $photoObj->photopath = $photopath;
            $photoObj->save(); 

            // 成功メッセージ
            $message = 'photo_'.$imgrole.'の店舗写真を追加・更新しました。';

        } catch (Exception $e) {
            // エラー処理
            Log::error("Error processing 外側のtrycatch: " . $e->getMessage());
            $error = 'エラーが発生しました、再アップロードしてください。';

        }finally{
            return response()->json(['message' => $message,'error' => $error,]);
        }
    }

    public function insert3(Request $request)
    {
        $error = "";
        $message = '';
        $storeid = 1; 
        // $s = $request->hasFile('photo_0');
        // info('変数の中身: ' . print_r($s, true));
        // dd($s);


        try{
            // バリデーション

            $rules = [
                'photo_0' => 'image|max:2048',
                'photo_1' => 'image|max:2048',
                'photo_2' => 'image|max:2048',
            ];

            session()->put(['key1' => $request->all()]);
            $requestList = $request->all();

            // $validator = Validator::make($request->all(), $rules);
            // //バリデーションに失敗した場合
            // if ($validator->fails()) {
            //     // 登録フォームに戻る
            //     $error = 'エラーが発生しました、再アップロードしてください。';
            //     return;
            // }
            /*
            ファイルの保存
            */
            $uploadDir = 'public/img/storephoto/';
            $photoDir = 'storage/img/storephoto/';

            $photoDataList = array();
            
            foreach ($requestList as $key => $value) {
                if($key !== "_token"){
                    $photoDataList[$key] = $value;
                }
            }

            foreach ($photoDataList as $i => $value) {
                $name_field = $i;
                $i = (int)$i;
            
                // ファイルフィールドの判定
                if (!$request->hasFile($name_field)) {
                    $message = $message."アップロードなし.";
                    continue;
                }
                $photoData = $request->file($name_field);

                /*
                    ファイル名の取得
                */
                // ファイル名を取得
                $photoname = $photoData->getClientOriginalName();
                $message = $message.$photoname;

                // 拡張子の取得
                $extension = $photoData->getClientOriginalExtension();

                //拡張子を除いたファイル名の取得
                $photoname = substr($photoname, 0, -strlen(".".$extension));

                //日付・拡張子を含むファイル名を生成
                $photoname = $photoname . '-' . time() . '.' . $extension;

                //ファイルのパスの取得
                $photopath = $photoDir.$photoname;

                //画像のアップロード
                $photoData->storeAs($uploadDir,$photoname);

                //モデルズにDBへの登録情報を格納
                $photoObj = storephotoinfo::where('storeid', $storeid)->where('imgrole', $i)->first();
                
                /*
                検索情報の有無を確認します。
                    ①情報が確認できなければ新規登録、
                    ②できれば更新処理
                */
                if (!$photoObj) {
                    // 新規登録の場合の処理
                    $photoObj = new storephotoinfo();
                    $photoObj->storeid = $storeid;
                    $photoObj->imgrole = $i;
                }
                $photoObj->photopath = $photopath;
                $photoObj->save(); 

                // 成功メッセージ
                $message = 'photo_'.$i.'の店舗写真を追加・更新しました。';

            }
        } catch (Exception $e) {
            // エラー処理
            Log::error("Error processing 外側のtrycatch: " . $e->getMessage());
            $error = 'エラーが発生しました、再アップロードしてください。';

        }finally{
            return response()->json(['message' => $message,'error' => $error,]);
        }
    }

    public function insert2(Request $request)
    {
        $error = "";
        $message = '';
        $storeid = 1; 
        // $s = $request->hasFile('photo_0');
        // info('変数の中身: ' . print_r($s, true));
        // dd($s);


        try{
            // バリデーション

            $rules = [
                'photo_0' => 'image|max:2048',
                'photo_1' => 'image|max:2048',
                'photo_2' => 'image|max:2048',
            ];

            // $validator = Validator::make($request->all(), $rules);
            // //バリデーションに失敗した場合
            // if ($validator->fails()) {
            //     // 登録フォームに戻る
            //     $error = 'エラーが発生しました、再アップロードしてください。';
            //     return;
            // }
            /*
            ファイルの保存
            */
            $uploadDir = 'public/img/storephoto/';
            $photoDir = 'storage/img/storephoto/';

           

            for ($i = 0; $i < 3; $i++) {
                //name属性の値の取得
                $name_field = 'photo_'.$i;

                try{
                    //ファイル情報の取得
                    $photoData = $request->file($name_field);

                    info($i.":".$photoData);
                    session()->put($i.':', $photoData);
                    if (!$photoData) {
                    // if (!$photoData) {
                        $message = $message."アップロードなし.";
                        info("nothing");
                        continue;
                    }
                    /*
                        ファイル名の取得
                    */
                    // ファイル名を取得
                    $photoname = $photoData->getClientOriginalName();
                    $message = $message.$photoname;
                    // 拡張子の取得
                    $extension = $photoData->getClientOriginalExtension();
                    //拡張子を除いたファイル名の取得
                    $photoname = substr($photoname, 0, -strlen(".".$extension));
                    //日付・拡張子を含むファイル名を生成
                    $photoname = $photoname . '-' . time() . '.' . $extension;

                    //ファイルのパスの取得
                    $photopath = $photoDir.$photoname;

                    //画像のアップロード
                    $photoData->storeAs($uploadDir,$photoname);

                    //モデルズにDBへの登録情報を格納
                    $photoObj = storephotoinfo::where('storeid', $storeid)->where('imgrole', $i)->first();
                    
                    /*
                    検索情報の有無を確認します。
                        ①情報が確認できなければ新規登録、
                        ②できれば更新処理
                    */
                    if (!$photoObj) {
                        // 新規登録の場合の処理
                        $photoObj = new storephotoinfo();
                        $photoObj->storeid = $storeid;
                        $photoObj->imgrole = $i;
                    }
                    $photoObj->photopath = $photopath;
                    $photoObj->save(); 

                    // 成功メッセージ
                    $message = 'photo_'.$i.'の店舗写真を追加・更新しました。';
                
                }catch(\Exception $e){
                    Log::error("Error processing photo_{$i}: " . $e->getMessage());
                }
            }


        } catch (Exception $e) {
            // エラー処理
            Log::error("Error processing 外側のtrycatch: " . $e->getMessage());
            $error = 'エラーが発生しました、再アップロードしてください。';

        }finally{
            return response()->json(['message' => $message,'error' => $error,]);
        }
    }
    public function storePhoto(Request $request)
    {
        $error = "";
        $dbErrorJudge = false;
        $store = null;
        $storeid = 1;
        $store = storeinfo::with(['stationinfo', 'storephotoinfo'])->firstWhere('storeid', $storeid);
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
                    'photo_0' => 'image|max:2048',
                    'photo_1' => 'image|max:2048',
                    'photo_2' => 'image|max:2048',
                ];
                // $rules = array();
                // for ($i = 0; $i < 3; $i++) {
                //     $key_name = (string)$i;
                //     $rules[$key_name] = 'required|image|max:2048';
                // }
                // $validator = Validator::make($request->all(), $rules);
                // echo("02：");
                // //バリデーションに失敗した場合
                // if ($validator->fails()) {
                //     // 登録フォームに戻る
                //     $error = 'エラーが発生しました、再アップロードしてください。';
                //     echo("03：".$error);
                //     return;
                // }
                /*
                ファイルの保存
                */
                $photoList = [new storephotoinfo(),new storephotoinfo(),new storephotoinfo()];
                $uploadDir = 'public/img/storephoto/';
                $photoDir = 'storage/img/storephoto/';

                for ($i = 0; $i < 3; $i++) {
                    echo("03");
                    //name属性の値の取得
                    $name_field = 'photo_'.$i;
                    //ファイル情報の取得
                    $photoData = $request->file($name_field);
                    /*
                        ファイル名の取得
                    */
                    // ファイル名を取得
                    $photoname = $photoData->getClientOriginalName();
                    if ($request->input($name_field, null) === "nothing") {
                        echo("con");
                        continue;
                    }

                    echo("name".$photoname );
                    // 拡張子の取得
                    $extension = $photoData->getClientOriginalExtension();
                    //拡張子を除いたファイル名の取得
                    $photoname = substr($photoname, 0, -strlen(".".$extension));
                    //日付・拡張子を含むファイル名を生成
                    $photoname = $photoname . '-' . time() . '.' . $extension;

                    //ファイルのパスの取得
                    $photopath = $photoDir.$photoname;

                    //画像のアップロード
                    $photoData->storeAs($uploadDir,$photoname);

                    //モデルズにDBへの登録情報を格納
                    $photoObj = storephotoinfo::where('storeid', $storeid)->where('imgrole', $i)->first();
                    
                    /*
                    検索情報の有無を確認します。
                        ①情報が確認できなければ新規登録、
                        ②できれば更新処理
                    */
                    if (!$photoObj) {
                        // 新規登録の場合の処理
                        $photoObj = new storephotoinfo();
                        $photoObj->storeid = $storeid;
                        $photoObj->imgrole = $i;
                    }
                    $photoObj->photopath = $photopath;
                    $photoObj->save();                    
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
                return view('admins/storeDetailByAdmin', compact('store'));
                // return redirect()->route('admins.storeDetail')->with(compact('message'));
            }else{
                // return redirect()->route('admins/store_photos/showForm')->with(compact('error'));
                return view('admins/store_photos/showForm', compact('store'));
            }
        }
    }


}
