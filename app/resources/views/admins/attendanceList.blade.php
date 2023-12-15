{{--
    プログラム名		：storeSearch.blade.php
    プログラム説明	：検索した店舗の一覧表示を行う
    作成日時			：
    作成者			：吉池悠理
--}}
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<title>List</title>
	</head>
	<body>
		<h1 align="center" style="margin-top: 21px;">{{ $store->storename }}の勤怠情報の表示画面</h1>
		<hr align="center" size="5" color="BLUE" width="950"></hr>
		<hr align="center" size="2" color="black" width="950"></hr>
		<br/>
		<div>
		<a href="{{asset('/admins/attendanceList/')}}?month=lastmonth">前月</a>
		<a href="{{asset('/admins/attendanceList/')}}">当月</a>
		<a href="{{asset('/admins/attendanceList/')}}?month=nextmonth">翌月</a>

		</div>
		<div align="center">
			<p>{{ $selectedDate->year }}年{{ $selectedDate->month }}月分</p>
		<table>
			<thead>
				<tr>
					<th>スタッフ名</th>
					@for($day = 1; $day <= $selectedDate->daysInMonth; $day++)
						<th><a href="{{asset('/admins/attendanceDetail')}}?year={{ $selectedDate->year }}&month={{ $selectedDate->month }}&day={{ $day }}">{{ $selectedDate->copy()->day($day)->format('d') }}日</a></th>
					@endfor
				</tr>
			</thead>
			<tbody>
				@foreach($store->staffinfo as $staff)
					<tr>
						<td>
						<a href="{{asset('/admins/attendanceDetail')}}?staffid={{$staff->staffid}}&year={{ $selectedDate->year }}&month={{ $selectedDate->month }}">{{ $staff->staffname }}</a>
						</td>


						@for($day = 1; $day <= $selectedDate->daysInMonth; $day++)
							<td>
								@php
									$date = $selectedDate->copy()->day($day)->format('Y-m-d');
									$attendance = $staff->attendinfo->firstWhere('workingdate', $date);
									$status = (!empty($attendance)) ? $attendance->attendance_status : '-';
								@endphp
								{{ $status }}
							</td>
						@endfor
					</tr>
				@endforeach
			</tbody>
	</table>
		</div>
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