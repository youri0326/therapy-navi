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
        <!-- データ入力フォーム -->
        <form action="StoreInsert.php" method="post">
            <input type="text" name="value1" placeholder="値1">
            <input type="text" name="value2" placeholder="値2">
            <input type="text" name="value3" placeholder="値3">
            <button type="submit">データを送信</button>
        </form>
    </body>
</html>