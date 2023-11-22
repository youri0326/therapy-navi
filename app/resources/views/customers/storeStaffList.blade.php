{{--
    プログラム名		：adminLogin.blade.php
    プログラム説明	：従業員一覧画面

--}}
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<title>List</title>
	</head>
	<body>
		<h1 align="center" style="margin-top: 21px;">従業員一覧画面</h1>
		<hr align="center" size="5" color="BLUE" width="950"></hr>
			<!-- ログインのコンテンツ部分 -->
			<div id="main" class="container">

				<form action="{{asset('/common/login')}}" method="POST">
				{{ csrf_field() }}
					<table class="input-table">
						<tr>
							<th>ユーザー</th>
							<td>
								<input type="text" size="25" name="accountid" value="修正時にセッション情報入れたい">
							</td>
						</tr>
						<tr>
							<th>パスワード</th>
							<td>
								<input type="password" size="25" name="password" value="修正時にセッション情報入れたい">
							</td>
						</tr>
					</table>
					<input type="hidden" size="25" name="authority" value="customer">
					<input type="submit" value="ログイン">
				</form>
			</div>
	</body>
</html>