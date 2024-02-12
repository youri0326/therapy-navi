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
                    <p>{{ Auth::user()->customerinfo->name }}さん</p>
                    <p>
                        <a href="{{route('customer.logout')}}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            ログアウト
                        </a>
                        <form id="logout-form" action="{{route('customer.logout')}}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </p>
                    <p><a href="{{asset('/customers/member/detail')}}">▶マイページ</a></p>
                @else
                    <p><a href="{{route('customer.login')}}">ログイン</a></p>
                    <p><a href="{{route('customers.registration.showForm')}}">会員登録</a></p>
                @endif
            </div>
        </header>