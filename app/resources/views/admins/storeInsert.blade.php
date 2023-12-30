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
		<title>店舗登録</title>
	</head>
	<body>
		<h1 align="center" style="margin-top: 21px;">店舗登録画面</h1>
		<hr align="center" size="5" color="BLUE" width="950"></hr>
		<!-- ログインのコンテンツ部分 -->
		<div id="main" class="container">

			<!-- storeInsert.blade.php -->

            <form action="{{ route('store.confirm') }}" method="post">
                @csrf
                <table>
                    <tbody>
                        <tr>
                            <th>店舗名*</th>
                            <td><input type="text" name="storename" placeholder="店舗名"></td>
                        </tr>
                        <tr>
                            <th>住所*</th>
                            <td><input type="text" name="address" placeholder="住所"></td>
                        </tr>
                        <tr>
                            <th>予算</th>
                            <td><input type="text" name="budget" placeholder="予算"></td>
                        </tr>
                            <th>コメント</th>
                            <td><input type="text" name="comment" placeholder="コメント"></td>
                        <tr>
                            <th>支払方法</th>
                            <td><input type="text" name="payment" placeholder="支払い方法"></td>
                        </tr>
                    </tbody>
                </table>
                <!-- 他のフォームフィールドもここに追加 -->
                <button type="submit">確認</button>
            </form>
		</div>
	</body>
</html>