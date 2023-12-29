{{--
    プログラム名    ：storeInsert.blade.php
    プログラム説明  ：検索した店舗の一覧表示を行う
    作成日時        ：
    作成者          ：佐藤泰樹
--}}
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<title>List</title>
	</head>
	<body>
		<h1 align="center" style="margin-top: 21px;">店舗登録画面</h1>
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
					<input type="hidden" size="25" name="authority" value="admin">
					<input type="submit" value="">
				</form>
			</div>
	</body>
</html>