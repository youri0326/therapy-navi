{{--
    プログラム名		：storeDetail.blade.php
    プログラム説明	：店舗詳細画面

--}}
@extends('customers.layouts.app')

@section('title', 'トップページ')

@section('content')

			<div align="center">
			@if($store->count() > 0)
				<table class="input-table">
					<tbody>
						@foreach($store as $store)
						<tr>
							<a href ="{{asset('/customers/storeMenu')}}?storeid={{$store->storeid}}">メニュー</a>
						</tr>
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
				@else
					<div class="research_title">
						<h3>店舗情報が見つかりませんでした。</h3>
						<a href="{{asset('/')}}">トップページ</a>
					</div>
				@endif
			</div>
			@endsection