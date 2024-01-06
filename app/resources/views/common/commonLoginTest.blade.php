{{--
    プログラム名		：adminLogin.blade.php
    プログラム説明	：ログインTest画面

--}}
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<title>List</title>
	</head>
	<body>
		<h1 align="center" style="margin-top: 21px;">ログインTest画面</h1>
		<hr align="center" size="5" color="BLUE" width="950"></hr>
			<!-- ログインのコンテンツ部分 -->
			<div id="main" class="container">
				@if (session('login_success'))
				<p>{{session('login_success')}}</p>
				@endif
                <p>{{Auth::user()->loginid}}</p>
                <p>{{Auth::user()->password}}</p>
                <p>{{Auth::user()->authority}}</p>
			</div>
	</body>
</html>