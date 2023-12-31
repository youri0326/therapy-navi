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
		<h1 align="center" style="margin-top: 21px;">店舗メニュー画面</h1>
		<hr align="center" size="5" color="BLUE" width="950"></hr>
			<!-- メニュー -->

			<!-- 店舗の詳細情報 -->
			<h2>店舗詳細表示</h2>
			<div id="main" class="container">
				<table class="input-table">
					<tbody>

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
							<th>最寄り駅</th>
							<td>
								@foreach ($store->stationinfo as $station)
								@if ($station === end($store->stationinfo))
								{{$station->stationname}}
								@else
								{{$station->stationname}},
								@endif
								@endforeach
							</td>
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
						<tr>
							<th>店舗写真</th>
							<td>
								@foreach ($store->storephotoinfo as $photo)
								{{$photo->photopath}},
								@endforeach
							</td>
						</tr>
					</tbody>
				</table>
				<h2>メニュー一覧</h2>
				<p><a href="{{asset('/admins/reservationList')}}">顧客・予約情報一覧</a></p>
				<p><a href="{{asset('/admins/attendanceList')}}">勤怠一覧</a></p>
				<p><a href="{{asset('/admins/store/update/showForm')}}">店舗情報更新</a></p>
				<p><a href="{{asset('/admins/storeMenu')}}">店舗メニュー一覧</a></p>

			</div>
	</body>
</html>