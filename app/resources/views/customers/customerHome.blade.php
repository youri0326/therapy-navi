{{--
    プログラム名		：customerHome.blade.php
    プログラム説明	：顧客側トップページ

--}}
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<title>List</title>
	</head>
	<body>
		<h1 align="center" style="margin-top: 21px;">顧客側トップページ</h1>
		<hr align="center" size="5" color="BLUE" width="950"></hr>
			<!-- ログインのコンテンツ部分 -->
			<div id="main" class="container">

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
			</div>
	</body>
</html>