{{--
    プログラム名		：menu.blade.php
    プログラム説明	：書籍販売システムのメニュー表示を行う
    作成日時			：2021/11/1
    作成者			：神田ITスクール
--}}
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<title>Menu</title>
	</head>
	<body>
		<h1 align="center" style="margin-top: 21px;">書籍販売システムWeb版 Ver.1.0</h1>
		<hr align="center" size="5" color="BLUE" width="950">
		<p align="center">
			<font size="5">MENU</font>
		</p>
		<hr align="center" size="2" color="BLACK" width="950">
		<div align="center">
    		<table>
    			<tr>
    				<td>
    					<a href="{{asset('/list')}}">【書籍一覧】</a>
						<a href="{{asset('/common/login')}}">ログイン</a>
    				</td>
    			</tr>
    			<tr>
    				<td>
    					<a href="">【書籍登録】</a>
    				</td>
    			</tr>
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
		<br>
		<br>
		<br>
		<hr align="center" size="5" color="blue" width="950">
		<div  align="center">
    		<table style="width:950px;">
    			<tr>
    				<td>copyright (c) all rights reserved.</td>
    			</tr>
    		</table>
		</div>
	</body>
</html>