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
		<table>
			<thead>
				<tr>
					<th>スタッフ名</th>
					@for($day = 1; $day <= $selectedDate->daysInMonth; $day++)
						<th>{{ $selectedDate->copy()->day($day)->format('Y-m-d') }}</th>
					@endfor
				</tr>
			</thead>
			<tbody>
				@foreach($store->staffinfo as $staff)
					<tr>
						<td>{{ $staff->staffname }}</td>
						@for($day = 1; $day <= $selectedDate->daysInMonth; $day++)
							<td>
								@php
									$date = $selectedDate->copy()->day($day)->format('Y-m-d');
									$attendance = $staff->attendinfo->firstWhere('workingdate', $date);
									$status = $attendance ? $attendance->attendance_status : '-';
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