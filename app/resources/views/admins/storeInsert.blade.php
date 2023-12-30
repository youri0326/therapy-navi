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

			<!-- storeInsert.blade.php -->

            <form action="{{ route('store.confirm') }}" method="post">
                @csrf
                <input type="text" name="storename" placeholder="店舗名">
                <input type="text" name="address" placeholder="住所">
                <input type="text" name="budget" placeholder="予算">
                <input type="text" name="comment" placeholder="コメント">
                <input type="text" name="payment" placeholder="支払い方法">
                <!-- 他のフォームフィールドもここに追加 -->
                <button type="submit">確認</button>
            </form>
		</div>
	</body>
</html>