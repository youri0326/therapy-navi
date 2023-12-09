{{--
    プログラム名		：storeMenu.blade.php
    プログラム説明	：店舗メニューの一覧表示を行う
    作成日時			：
    作成者			：佐藤泰樹
--}}
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<title>店舗メニュー一覧</title>
	</head>
	<body>
		<h1 align="center" style="margin-top: 21px;">店舗メニュー一覧</h1>
		<hr align="center" size="5" color="BLUE" width="950"></hr>
		<hr align="center" size="2" color="black" width="950"></hr>
		<br/>
		<div align="center">
			@foreach($store as $store)
				<h2>{{$store->storename}}</h2>
				<table  style="border:2;">
    				<tr>
						<th bgcolor="#6666FF" width="200">サービス名</th>
						<th bgcolor="#6666FF" width="100">サービス時間</th>
						<th bgcolor="#6666FF" width="250">説明</th>
						<th bgcolor="#6666FF" width="200">金額</th>
					</tr>
					@foreach($store->storemenuinfo as $menu)
					<tr>
						<td>{{$menu->servicename}}</td>
						<td>{{$menu->servicetime}}分</td>
						
						<td>{{$menu->description}}</td>
						<td>{{number_format($menu->amount)}}円</td>
					</tr>
					@endforeach
    			</table>
			@endforeach
		</div>
		<hr align="center" size="5" color="blue" width="950"></hr>
		<div  align="center">
    		<table style="width:950px;">
    			<tr>
    				<td>copyright (c) all rights reserved.</td>
    			</tr>
    		</table>
		</div>
	</body>
</html>