{{--
    プログラム名    ：storeInsert.blade.php
    プログラム説明  ：検索した店舗の一覧表示を行う
    作成日時        ：
    作成者          ：佐藤泰樹
--}}
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<title>List</title>
	</head>
	<body>
		<h1 align="center" style="margin-top: 21px;">店舗登録画面</h1>
		<hr align="center" size="5" color="BLUE" width="950"></hr>
		<!-- ログインのコンテンツ部分 -->
		<div id="main" class="container">
            <!-- storeInsertConfirm.blade.php -->

            <h2>登録内容確認</h2>
            <p>店舗名: {{ $data['storename'] }}</p>
            <p>住所: {{ $data['address'] }}</p>
            <p>予算: {{ $data['budget'] }}</p>
            <p>コメント: {{ $data['comment'] }}</p>
            <p>支払い方法: {{ $data['payment'] }}</p>
            <!-- 他のフォームフィールドもここに追加 -->

            <form action="{{ route('store.store') }}" method="post">
                @csrf
                @foreach($data as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach
                <button type="submit">登録する</button>
            </form>
        </div>
    </body>
</html>