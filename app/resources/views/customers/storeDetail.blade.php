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
				<table class="input-table">
					@foreach($store as $store)
					<tr>
               			<th>店舗ID</th><td>{{$store->storeid}}<td>
					</tr>
               		<tr>
						<td>店舗名</th>{{</th>$store->storename}}</td>
					</tr>
					<tr>
						<td>住所</th>{{$store->address}}</td>
					</tr>
					<tr>
						<td>予算</th>{{$store->budget}}</td>
					<\tr>
					<tr>
						<td>備考欄</th>{{$store->comment}}</td>
					</tr>
					<tr>
						<td>支払方法</th>{{$store->payment}}</td>
					</tr>
					@endforeach
				</table>
			</div>
	</body>
</html>