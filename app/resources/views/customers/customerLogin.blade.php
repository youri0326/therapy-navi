{{--
    プログラム名		：customerLogin.blade.php
    プログラム説明	：顧客のログイン画面

--}}
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<!-- CSS only -->

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link src="{{asset('/css/app.css')}}" rel="stylesheet">
		<link src="{{asset('/css/signin.css')}}" rel="stylesheet">
		<link src="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet">
		<title>List</title>
	</head>
	<body>
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
			<div id="main" class="container">
				<form action="{{asset('/common/login')}}" method="POST" class="form-signin">
						{{ csrf_field() }}
					<h1 class="h3 mb-3 font-weight-normal">顧客ログイン</h1>
					<label for="inputEmail" class="sr-only">ログインID</label>
					<input type="text" name="loginid" id="inputEmail" class="form-control" placeholder="ログインID" required autofocus>
					<label for="inputPassword" class="sr-only">パスワード</label>
					<input type="password" name="password" id="inputPassword" class="form-control" placeholder="パスワード" required>
					<input type="hidden" size="25" name="authority" value="0">
					<button class="btn btn-lg btn-primary btn-block" type="submit">ログイン</button>
				</form>
			</div>
		<!-- JS, Popper.js, and jQuery -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>		<script src="{{asset('/js/app.js')}}"></script>
	</body>
</html>