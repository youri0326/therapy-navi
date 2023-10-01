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
    		<table  style="width:850px;">
    			<tr>
    				<td width="80">[<a href="{{asset('/')}}">メニュー</a>]</td>
    				<td width="80">[<a href="">書籍登録</a>]</td>
    				<td width="690" align="left" >
    					　　　　　　　　　　　　　　　　
    					<font size="5">書籍一覧</font>
    				</td>
    			</tr>
    		</table>
		</div>
		<hr align="center" size="2" color="black" width="950"></hr>
		<div align="center">
    		<table>
    			<tr>
    				<td>
    					<form action="">
    						ISBN:<input type=text size="23" name="isbn"  value="{{old('isbn')}}" />
    						TITLE:<input type=text size="23" name="title"  value="{{old('title')}}" />
    						価格:<input type=text size="23" name="price"  value="{{old('price')}}" />
    						<input type="submit" value="検索" />
    					</form>
    				</td>
    				<td>
    					<form action="">
    						<input type="submit" value="全件表示" />
						</form>
    				</td>
    
    			</tr>
    		</table>
		</div>
		<br/>
		<div align="center">
    		<table  style="border:2;">
    			<tr >
    				<th bgcolor="#6666FF" width="200">ISBN</th>
    				<th bgcolor="#6666FF" width="200">TITLE</th>
    				<th bgcolor="#6666FF" width="200">価格</th>
    				<th bgcolor="#6666FF" width="250">更新/削除</th>
    			</tr>
    				@foreach($bookList as $book)
    				<tr>
        				<td align=center>
        					<a href="">{{$book->isbn}}</a>
    					</td>
        				<td align=center>{{$book->title}}</td>
        				<td align=center>{{$book->price}}円</td>
        				<td align=center>
        					<a href=''>更新</a>　
        					<a href=''>削除</a>
    					</td>
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