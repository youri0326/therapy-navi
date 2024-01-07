<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- CSS only -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<!-- <link src="{{asset('/css/app.css')}}" rel="stylesheet">
		<link src="{{asset('/css/signin.css')}}" rel="stylesheet">
		<link src="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet"> -->
        <title>@yield('title')</title>
	</head>
	<body>
        <header>
            <div class="header-container">
                @if (Auth::check())
                    <p>{{Auth::user()->storeinfo->storename}}</p>
                    <p><a href="{{route('admins.storeDetail')}}">▶店舗詳細</a></p>
                @else
                    <p><a href="{{route('admin.login')}}">ログイン</a></p>
                    <p><a href="{{asset('/admins/store/showInsertForm')}}">店舗登録</a></p>
                @endif
            </div>
        </header>