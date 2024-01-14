{{--
    プログラム名		：customers.registration.showForm.blade.php
    プログラム説明	：顧客側トップページ

--}}
@extends('customers.layouts.app')

@section('title', '会員登録')

@section('content')
  <h1>会員登録</h1>
  @if(session('error'))
  <p>{{ session('error') }}</p>
  @endif
  <form action="{{ route('customers.registration.confirm') }}" method="post">
    @csrf
    <p>お名前:<input type="text" name="name" placeholder="お名前" required="required" value="田中"></p>
    <p>ふりがな:<input type="text" name="furigana" placeholder="ふりがな" onblur="validateKana(this)" required="required" value="たなか"></p>
    <p>ログインID:<input type="text" name="loginid" placeholder="ログインID" required="required" value="00011"></p>
    <p>パスワード:<input type="password" name="password" placeholder="パスワード" required="required" value="test555"></p>
    <p>メールアドレス:<input type="email" name="email" placeholder="メールアドレス" required="required" value="youri@gmail.com"></p>
    <p>電話番号:<input type="text" name="phone" placeholder="電話番号" onblur="validatePhone(this)" required="required" value="090-6877-1111"></p>
    <p>生年月日:<input type="date" name="birthday" placeholder="生年月日" onblur="validateBirthday(this)" required="required" value="1990/09/11"></p>
    <p>住所:<input type="text" name="address" placeholder="住所" required="required" value="東京"></p>
    <p><input type="submit" value="登録"></p>
  </form>
  <script>
  function validateKana(input) {
    const hiraganaPattern = /^[ぁ-んー]*$/; // ひらがなのみを許容する正規表現
    if (!hiraganaPattern.test(input.value)) {
      alert("ふりがなはひらがなで入力してください。");
      input.value = ""; // 不正な値をクリア
    }
  }

  function validatePhone(input) {
    const phonePattern = /^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/; // 電話番号の形式をチェックする正規表現
    if (!phonePattern.test(input.value)) {
      alert("電話番号は正しい形式で入力してください。（例：03-1234-5678）");
      input.value = ""; // 不正な値をクリア
    }
  }
  function validateBirthday(input) {
    // 日付形式
    const datePattern = /^[0-9]{4}-[0-9]{2}-[0-9]{2}$/; // 日付形式をチェックする正規表現
    // if (!input.value.match(/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/)) {
    if (!datePattern.test(input.value)) {
      input.setCustomValidity("日付形式はYYYY-MM-DDで入力してください");
      return false;
    } else {
      input.setCustomValidity("");
      return true;
    }

  } 
</script>

@endsection