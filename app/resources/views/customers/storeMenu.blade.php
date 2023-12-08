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
		<title>List</title>
	</head>
	<body>
		<h1 align="center" style="margin-top: 21px;">店舗メニュー一覧</h1>
		<hr align="center" size="5" color="BLUE" width="950"></hr>
		<hr align="center" size="2" color="black" width="950"></hr>
		<br/>
		<p>aa{{$address}}</p>
		<div align="center">
    		<table  style="border:2;">
    			<tr >
    				<th bgcolor="#6666FF" width="200"></th>
    				<th bgcolor="#6666FF" width="200"></th>
    				<th bgcolor="#6666FF" width="200"></th>
    				<th bgcolor="#6666FF" width="250"></th>
                    <th bgcolor="#6666FF" width="250"></th>
    			</tr>
    				@foreach($stormenuid as $menu)
    				<tr>
        				<td align=center>
        					{{$menu->servicename}}
    					</td>
						td align=center>
        					{{$menu->description}}
    					</td>
						td align=center>
        					{{$menu->amount}}
    					</td>
						td align=center>
        					{{$menu->servicetime}}
    					</td>
        				<td align=center>
							@if($store->storephotoinfo->count() > 0)
								<ul>
								@foreach($store->storephotoinfo as $photo)
									<li>{{ $photo->photopath }}</li>
								@endforeach
								</ul>
							@endif
						</td>
						<td align=center>
							@if($store->stationinfo->count() > 0)
								<ul>
								@foreach($store->stationinfo as $station)
									<li>{{ $station->stationname }}</li>
								@endforeach
								</ul>
							@endif
						</td>
						<td align=center>{{$store->comment}}</td>
						<td align=center>
							@if($store->storemenuinfo->count() > 0)
								<ul>
								@foreach($store->storemenuinfo as $menu)
									<li>{{ $menu->servicename }}</li>
								@endforeach
								</ul>
							@endif
						</td>
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