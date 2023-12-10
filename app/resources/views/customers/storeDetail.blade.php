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
			<!-- メニュー -->
			@foreach($store as $store)
				<a href ="{{asset('/customers/storeDetail')}}?storeid={{$store->storeid}}">メニュー</a>
			@endforeach
			<!-- 店舗の詳細情報 -->
			<div id="main" class="container">
				<table class="input-table">
					<tbody>
					@foreach($store as $store)
					<tr>
               			<th>店舗ID</th><td>{{$store->storeid}}<td>
					</tr>
               		<tr>
						<th>店舗名</th><td>{{$store->storename}}</td>
					</tr>
					<tr>
						<th>住所</th><td>{{$store->address}}</td>
					</tr>
					<tr>
						<th>予算</th><td>{{$store->budget}}</td>
					</tr>
					<tr>
						<th>備考欄</th><td>{{$store->comment}}</td>
					</tr>
					<tr>
						<th>支払方法</th><td>{{$store->payment}}</td>
					</tr>
					@endforeach
					</tbody>
				</table>
			</div>
	</body>
</html>