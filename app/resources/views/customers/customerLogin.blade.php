{{--
    プログラム名		：list.blade.php
    プログラム説明	：書籍販売システムの一覧表示を行う
    作成日時			：2021/11/1
    作成者			：神田ITスクール
--}}
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<title>List</title>
	</head>
	<body>
		<h1 align="center" style="margin-top: 21px;">書籍販売システムWeb版 Ver.1.0</h1>
		<hr align="center" size="5" color="BLUE" width="950"></hr>
		<div align="center">
    		<table  style="border:2;">
    			<tr >
    				<th bgcolor="#6666FF" width="200">accountid</th>
    				<th bgcolor="#6666FF" width="200">password</th>
    				<th bgcolor="#6666FF" width="200">email</th>
    				<th bgcolor="#6666FF" width="250">phone</th>
    				<th bgcolor="#6666FF" width="250">authority</th>
    			</tr>
    				@foreach($accountList as $account)
    				<tr>
        				<td align=center>{{$account->accountid}}</td>
        				<td align=center>{{$account->password}}</td>
        				<td align=center>{{$account->email}}</td>
        				<td align=center>{{$account->phone}}</td>
        				<td align=center>{{$account->authority}}</td>
        			</tr>
        			@endforeach
    		</table>
		</div>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<hr align="center" size="5" color="blue" width="950"></hr>
		<div  align="center">
    		<table style="width:950px;">
    			<tr>
    				<td>copyright (c) all rights reserved.</td>
    			</tr>
    		</table>
		</div>
	</body>
</html>