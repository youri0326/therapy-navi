{{--
    プログラム名		：memberDetail.blade.php
    プログラム説明	：会員情報画面

--}}
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<title>List</title>
	</head>
	<body>
		<h1 align="center" style="margin-top: 21px;">会員情報画面画面</h1>
		<hr align="center" size="5" color="BLUE" width="950"></hr>
			<!-- ログインのコンテンツ部分 -->
			<div id="main" class="container">
                <p>{{$accountid}}</p>
                <p>{{$password}}</p>
			</div>
	</body>
</html>