<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customerinfo;
use App\Models\user;
use Exception;
use Illuminate\Support\Facades\Validator;

class CustomerRegisterController extends Controller
{
  public function showForm()
  {
    return view('customers/registration/showForm');
  }

  public function confirm(Request $request)
  {
    $error = "";
    
    // 【検索データの取得】
    try {
      //入力された情報を、userインスタンスを介して取得
      $user = new user();
      $user->loginid = $request->loginid;
      $user->password = $request->password;
      $user->email = $request->email;
      $user->phone = $request->phone;
  
      //入力された情報を、customerinfoインスタンスを介して取得
      $customer = new customerinfo();
      $customer->name = $request->name;
      $customer->furigana = $request->furigana;
      $customer->birthday = $request->birthday;
      $customer->address = $request->address;
      // バリデーション
      $rules = [
          'name' => 'required|max:255',
          'furigana' => 'required|max:255|regex:/^[ぁ-んァ-ンー]+$/u',
          'birthday' => 'required|date',
          'address' => 'required|max:255',
          'email' => 'required|email',
          'phone' => 'required|min:9|max:15',
          'loginid' => 'required|max:255',
          'password' => 'required|min:4|max:255',
      ];
      $validator = Validator::make($request->all(), $rules);

      //バリデーションに失敗した場合
      if ($request->$validator->fails()) {
          // 登録フォームに戻る
          $error = 'エラーが発生しました、再入力してください。';
      }

    } catch (Exception $e) {
        // エラー処理
        $error = 'エラーが発生しました、再入力してください。';
    }finally{
        if($error===""){
            // 確認画面を表示
            return view('customers/registration/confirmation', compact('user', 'customer'));
        }else{
            return redirect()->route('customers.registration.showForm')->with(compact('error'));;
        }
    }
  }
  
  public function insert(Request $request)
  {
    $rules = [
      'name' => 'required|max:255',
      'furigana' => 'required|max:255|regex:/^[ぁ-んァ-ンー]+$/u',
      'birthday' => 'required|date',
      'address' => 'required|max:255',
      'email' => 'required|email',
      'phone' => 'required|min:9|max:15',
      'loginid' => 'required|max:255',
      'password' => 'required|min:4|max:255',
    ];
    $validator = Validator::make($request->all(), $rules);

    //バリデーションに失敗した場合
    if ($request->$validator->fails()) {
        // 登録フォームに戻る
        $error = 'エラーが発生しました、再入力してください。';
    }

    // ユーザー情報の作成
    $user= new user();
    $user->loginid = $request->loginid;
    $user->password = bcrypt($request->password);
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->authority = 0;
    $user->save();

    // 顧客情報の作成
    $customer = new customerinfo();
    $customer->name = $request->name;
    $customer->furigana = $request->furigana;
    $customer->birthday = $request->birthday;
    $customer->address = $request->address;
    $user->customerinfo()->save($customer);

    // 登録完了画面にリダイレクト
    return view('customers/registration/completion', compact('user', 'customer'));
  }
}
