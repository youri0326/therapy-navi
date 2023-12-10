{{--
    プログラム名		：.blade.php
    プログラム説明	：
    作成日時			：
    作成者			：吉池悠理
--}}
<!DOCTYPE html>
<html lang="en">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<title>スタッフの勤怠詳細情報</title>
	</head>
<body>
    <h2>{{ $staff->staffname }}の{{ $selectedDate->format('Y年m月') }}の勤怠情報</h2>

    <table>
        <thead>
            <tr>
                <th>日付</th>
                <th>出勤時間</th>
                <th>退勤時間</th>
            </tr>
        </thead>
        <tbody>
        @for($day = 1; $day <= $selectedDate->daysInMonth; $day++)
            @php
                $date = $selectedDate->copy()->day($day)->format('Y-m-d');
                $attendance = $staff->attendinfo->firstWhere('workingdate', $date);
            @endphp
            <tr>
                <td>{{$day}}日</td>
                @if (!empty($attendance))
					<td>
                        {{substr($attendance->starttime, 0, 5)}}
					</td>
					<td>
                        {{substr($attendance->endtime, 0, 5)}}
					</td>
                @else
                    <td>
    				</td>
					<td>
    				</td>
                @endif
            </tr>
        @endfor
        </tbody>
    </table>
</body>
</html>