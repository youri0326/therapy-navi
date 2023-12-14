{{--
    プログラム名		：reservationList.blade.php
    プログラム説明	：予約一覧画面

--}}
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<title>List</title>
	</head>
	<body>
		<h1 align="center" style="margin-top: 21px;">予約一覧画面</h1>
		<hr align="center" size="5" color="BLUE" width="950"></hr>

			<!-- 予約一覧 -->
			<div id="main" class="container">
				<table class="input-table">
                    <tbody>
                        @foreach($reservationList as $reserve)
                            <tr>
                                <th>予約日時</th><td>{{$reserve->reservedatetime}}<td>
                            </tr>
                            <tr>
                                <th>予約日時</th><td>{{$reserve->reservedatetime}}<td>
                            </tr>
                            <tr>
                                <th>支払方法</th><td>{{$reserve->payment}}</td>
                            </tr>
                            <tr>
                                <th>支払い状況</th><td>{{$reserve->status}}</td>
                            </tr>
                            <tr>
                                <th>追記事項</th><td>{{$reserve->addcomment}}</td>
                            </tr>
                        @endforeach
                    </tbody>
				</table>
			</div>
	</body>
</html>