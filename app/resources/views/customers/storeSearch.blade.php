{{--
    プログラム名		：storeSearch.blade.php
    プログラム説明	：検索した店舗の一覧表示を行う
    作成日時			：
    作成者			：吉池悠理
--}}
@extends('customers.layouts.app')

@section('title', 'トップページ')

@section('content')

		<h2>{{$address}}の整体院一覧</h2>
		<div align="center">
		@if($storeList->count() > 0)
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

							@if($store->storephotoinfo->where('imgrole', 0)->count() > 0)
								<ul>
									@php
									$photopath = $photo->photopath;
									if(str_contains($photopath, '.jpg')){
										$photoName = str_replace('.jpg', '', $photopath);
									}
									elseif(str_contains($photopath, '.png')){
										$photoName = str_replace('.png', '', $photopath);
									}
									@endphp
									<li><img src="{{asset($photo->photopath)}}" alt="{{ $photoName }}"></li>
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
							@if($store->storemenuinfo->where('servicerole', 0)->count() > 0)
								<ul>
									@foreach($store->storemenuinfo->where('servicerole', 0) as $menu)
										<li>{{ $menu->servicename }}/{{ $menu->amount }}円</li>
									@endforeach
								</ul>
							@endif
						</td>
					</tr>


					@endforeach
    		</table>
			<div class="pagination">
						{{ $storeList->links() }}
			</div>
		@else
			<div class="research_title">
				<h3>ご指定の条件に該当するお店は見つかりませんでした。</h3>
				<p>検索条件を変更して、再度検索してください。</p>
			</div>
			@include('customers.layouts.storeSearchForm')
		@endif
		</div>
		@endsection