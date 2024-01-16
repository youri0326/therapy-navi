{{--
    プログラム名		：error.blade.php
    プログラム説明	：顧客側エラーページ

--}}
@extends('customers.layouts.app')

@section('title', 'エラーページ')

@section('content')
	<div>
		<p>{{$error}}</p>
		<p><a href="{{route($link['href'])}}">{{$link['text']}}</a></p>
	</div>
@endsection