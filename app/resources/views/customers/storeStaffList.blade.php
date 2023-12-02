{{--
    プログラム名	：storeStaffList.blade.php
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
							<th>従業員ID</th>
							<th>氏名</th>
							<th>フリガナ</th>
							<th>性別</th>
							<th>施術開始歴</th>
							<th>年齢</th>
							<th>写真</th>
						</tr>
						@foreach($storeinfo ?? '' as $store)
						<tr>
							<td>
								<a>{{$store->staffid}}</a>
							</td>
							<td>
								<a>{{$store->staffname}}</a>
							</td>
							<td>
								<a>{{$store->stafffurigana}}</a>
							</td>
							<td>
								<a>{{$store->gender}}</a>
							</td>
							<td>
								<a>{{$store->treathistory}}</a>
							</td>
							<td>
								<a>{{$store->staffbirthday}}</a>
							</td>
						</tr>
						@endforeach
						</table>
					<input type="hidden" size="25" name="authority" value="customer">
					<input type="submit" value="ログイン">
				</form>
			</div>
	</body>
</html>