{{--
    プログラム名		：adminLogin.blade.php
    プログラム説明	：管理者のログイン画面

--}}
@extends('customers.layouts.app')

@section('title', '管理者のログイン画面')

@section('content')
	<!-- ログインのコンテンツ部分 -->
	@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	@if (session('login_error'))
		<p>{{session('login_error')}}</p>
	@endif
	<form action="{{asset('/common/login')}}" method="POST" class="form-signin">
	@csrf
		<h1 class="h3 mb-3 font-weight-normal">管理者ログイン</h1>
		<label for="inputEmail" class="sr-only">ログインID</label>
		<input type="text" name="loginid" id="inputEmail" class="form-control" placeholder="ログインID" required autofocus>
		<label for="inputPassword" class="sr-only">パスワード</label>
		<input type="password" name="password" id="inputPassword" class="form-control" placeholder="パスワード" required>
		<input type="hidden" size="25" name="authority" value="1">
		<button class="btn btn-lg btn-primary btn-block" type="submit">ログイン</button>
	</form>
@endsection