{{--
    プログラム名		：storeSearch.blade.php
    プログラム説明	：検索した店舗の一覧表示を行う
    作成日時			：
    作成者			：吉池悠理
--}}
@extends('customers.layouts.app')

@section('title', 'トップページ')

@section('content')

		<p>aa{{$address}}</p>
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
        					<a href ="{{asset('/customers/storeDetail')}}?storeid={{$store->storeid}}">{{$store->storename}}</a>
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
		@endsection