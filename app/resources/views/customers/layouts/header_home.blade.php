<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- CSS only -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<!-- <link src="{{asset('/css/app.css')}}" rel="stylesheet">
		<link src="{{asset('/css/signin.css')}}" rel="stylesheet">
		<link src="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet"> -->
        <title>@yield('title')</title>
        <!-- Favicon -->
        <link rel="icon" href="" sizes="any">
        <!-- OGP -->
        <meta property="og:url" content="https://(サイトのドメイン)/" /> <!-- ドメインを入力してください -->
        <meta property="og:title" content="セラピー　探しナビ" />
        <meta property="og:type" content="website" />
        <meta property="og:description" content="" />
        <meta property="og:image" content="https://(サイトのドメイン)/Ribe/img/ribe-ogp.jpg" /> <!-- ドメインを入力してください -->
        <!-- X(Twitter) OGP -->
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:site" content="" />
        <meta name="twitter:domain" content="" />
        <meta name="twitter:title" content="" />
        <meta name="twitter:description" content="" />
        <meta name="twitter:image" content="https://(サイトのドメイン)/" /> <!-- ドメインを入力してください -->

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@200;400;500;600;700&family=Noto+Serif+JP:wght@200;400;500;600;700&display=swap"
            rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    </head>
	<body>

        <header class="header" id="header">
            <div class="header_inner">
            <a class="header_logo-link" href="">
                <p>セラピー<span>探しナビ</span></p>
            </a>
            <nav class="header-nav">
                <div class="header-nav-list md-none">
                @if (Auth::check())
                    <p>{{ Auth::user()->customerinfo->name }}さん</p>
                    <ul class="header-nav-list-items">
                        <li class="header-nav-item">
                        <a href="{{route('logout')}}" class="header-nav-item-link">ログアウト</a>
                        </li>
                        <li class="header-nav-item">
                        <a href="{{asset('/customers/member/detail')}}" class="header-nav-item-link">マイページ</a>
                        </li>
                    </ul>
                @else
                    <ul class="header-nav-list-items">
                        <li class="header-nav-item">
                        <a href="{{route('customer.login')}}" class="header-nav-item-link">ログイン</a>
                        </li>
                        <li class="header-nav-item">
                        <a href="{{route('customers.registration.showForm')}}" class="header-nav-item-link">登録</a>
                        </li>
                    </ul>
                @endif
                </div>
            </nav>
            <div class="hamburger js-hamburger">
                <div class="hamburger__container">
                <span></span>
                <span></span>
                <span></span>
                </div>
            </div>

            <div class="drawer-menu js-drawer">

                <a class="header_logo-link drawer-menu-logo" href="">
                <p>セラピー<span>探しナビ</span></p>
                </a>
                <div class="drawer-menu_inner">
                @if (Auth::check())
                    <ul class="drawer-menu-items">
                        <li class="drawer-menu-item">
                        <a href="{{route('logout')}}" class="header-nav-item-link  drawer-menu-login">ログアウト</a>
                        </li>
                        <li class="drawer-menu-item">
                        <a href="{{asset('/customers/member/detail')}}" class="header-nav-item-link  drawer-menu-register">マイページ</a>
                        </li>
                    </ul>
                @else
                    <ul class="drawer-menu-items">
                        <li class="drawer-menu-item">
                        <a href="{{route('customer.login')}}" class="header-nav-item-link  drawer-menu-login">ログイン</a>
                        </li>
                        <li class="drawer-menu-item">
                        <a href="{{route('customers.registration.showForm')}}" class="header-nav-item-link  drawer-menu-register">登録</a>
                        </li>
                    </ul>
                @endif
                </div>
            </div>
            </div>
        </header>