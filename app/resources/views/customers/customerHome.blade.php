{{--
    プログラム名		：customerHome.blade.php
    プログラム説明	：顧客側トップページ

--}}
@extends('customers.layouts.app')

@section('title', 'トップページ')

@section('content')
	<form action="{{asset('/customers/storeSearch')}}" method="GET">
		<table class="input-table">
			<tr>
				<th>地域※必須</th>
				<td>
					<input type="text" size="25" name="address" >
				</td>
			</tr>
			<tr>
				<th>駅名</th>
				<td>
					<input type="text" size="25" name="station" >
				</td>
			</tr>
			<tr>
				<th>店名</th>
				<td>
					<input type="password" size="25" name="storename" >
				</td>
			</tr>
			<tr>
				<th>その他</th>
				<td>
					<input type="password" size="25" name="comment">
				</td>
			</tr>
		</table>
		<input type="submit" value="検索">
	</form>
@endsection