{{--
    プログラム名		：storeDetail.blade.php
    プログラム説明	：店舗詳細画面

--}}
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<title>List</title>
	</head>
	<body>
		<h1 align="center" style="margin-top: 21px;">店舗詳細画面</h1>
		<hr align="center" size="5" color="BLUE" width="950"></hr>
			<!-- 店舗の詳細情報 -->
			<div id="main" class="container">
                <p>{{$store->storeid}}</p>
                <p>{{$store->storename}}</p>
				<p>{{$store->address}}</p>
				<p>{{$store->budget}}</p>
				<p>{{$store->comment}}</p>
				<p>{{$store->payment}}</p>
			</div>
	</body>
</html>