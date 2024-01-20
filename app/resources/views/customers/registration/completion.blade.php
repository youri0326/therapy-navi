{{--
    プログラム名		：.blade.php
    プログラム説明	：予約確認画面

--}}

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<title>予約一覧</title>
	</head>
	<body>
		<h1 align="center" style="margin-top: 21px;">予約確認画面</h1>
		<hr align="center" size="5" color="BLUE" width="950"></hr>
        <div class="container">
            <h2>登録完了</h2>
            <p>登録が次の内容で無事成功しました。</p>
            <h3>登録情報一覧</h3>
            <p>お名前: {{ $customer->name}}</p>
            <p>ふりがな: {{ $customer->furigana}}</p>
            <p>ログインID: {{ $user->loginid}}</p>	
            <p>パスワード: {{ $user->password}}</p>	
            <p>メールアドレス: {{ $user->email}}</p>
            <p>電話番号: {{ $user->phone}}</p>
            <p>生年月日: {{ $customer->birthday}}</p>
            <p>住所: {{ $customer->address}}</p>


            <a href="{{asset('/')}}">検索画面に戻る</a>
        </div>
	</body>
</html>
