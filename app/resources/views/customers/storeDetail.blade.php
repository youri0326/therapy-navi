{{--
    プログラム名		：storeDetail.blade.php
    プログラム説明	：店舗詳細画面

--}}
@extends('customers.layouts.app')

@section('title', 'トップページ')

@section('content')

			<div align="center">
			@foreach($store->storephotoinfo as $photo)
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
			@endforeach
			
			@if($store->count() > 0)
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
							@foreach($store->stationinfo as $station)
								{{$station->stationname}}/
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
					</tbody>
				</table>
					<a href ="{{asset('/customers/storeMenu')}}?storeid={{$store->storeid}}">メニュー</a>
				<div id="map" style="height:500px">
				<script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=[APIキーをここに入力]&callback=initMap" async defer>
				</script>
				</div>
				@else
					<div class="research_title">
						<h3>店舗情報が見つかりませんでした。</h3>
						<a href="{{asset('/')}}">トップページ</a>
					</div>
				@endif
			</div>
			@endsection