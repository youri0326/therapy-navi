@extends('layouts.laravel3')

@section('title', '書籍詳細')

@section('content')
	@if($userInfo['auth'] == 2)
		<div align="center">
    		<table class="table-detail">
    			<tr>
    				@foreach($detailBook as $book)
        				<td>
        					<form action="{{asset('/update')}}" method="get">
        						@csrf
        						<input type="submit" value="&nbsp;変更&nbsp;">
        						<input type="hidden" name="isbn" value="{{$book->isbn}}">
        					</form>
        				</td>
        				<td>
        					<form action="{{asset('/delete')}}" method="get">
        						@csrf
        						<input type="submit" value="&nbsp;削除&nbsp;">
        						<input type="hidden" name="isbn" value="{{$book->isbn}}">
        					</form>
        				</td>
    				@endforeach
    			</tr>
    		</table>
		</div>
		<br>
	@endif
		<div class="content">
    		<table class="detail-border">
    			@foreach($detailBook as $book)
        			<tr>
        				<th>ISBN</th>
        				<td>{{$book->isbn}}</td>
        			</tr>
        			<tr>
        				<th>TITLE</th>
        				<td>{{$book->title}}</td>
        			</tr>
        			<tr>
        				<th>価格</th>
        				<td>{{number_format($book->price)}}円</td>
        			</tr>
    			@endforeach
    		</table>
    	</div>
@endsection
