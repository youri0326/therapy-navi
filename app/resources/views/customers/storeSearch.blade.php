{{--
    プログラム名		：storeSearch.blade.php
    プログラム説明	：検索した店舗の一覧表示を行う
    作成日時			：
    作成者			：吉池悠理
--}}
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<title>List</title>
	</head>
	<body>
		<h1 align="center" style="margin-top: 21px;">店舗検索画面</h1>
		<hr align="center" size="5" color="BLUE" width="950"></hr>
		<hr align="center" size="2" color="black" width="950"></hr>
		<br/>
		<div align="center">
    		<table  style="border:2;">
    			<tr >
    				<th bgcolor="#6666FF" width="200">店名</th>
    				<th bgcolor="#6666FF" width="200">店写真</th>
    				<th bgcolor="#6666FF" width="200">最寄り駅</th>
    				<th bgcolor="#6666FF" width="250">コメント</th>
                    <th bgcolor="#6666FF" width="250">主なメニュー</th>
    			</tr>
    				@foreach($storeList as $store)
    				<tr>
        				<td align=center>
        					{{$store->storename}}</a>
    					</td>
        				<td align=center>
							@foreach ($store->storephotoinfo as $storephoto)
							{{ $storephoto-> photopath}} ,
							@endforeach
						</td>
        				<td align=center>
							@foreach ($store->stationinfo as $station)
							{{ $station-> stationname}} ,
							@endforeach
						</td>
						<td align=center>{{$store->comment}}</td>
						<td align=center>{{$store->storemenuinfo->find(1)->servicename}}円</td>
        			</tr>
        			@endforeach
    		</table>
		</div>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
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