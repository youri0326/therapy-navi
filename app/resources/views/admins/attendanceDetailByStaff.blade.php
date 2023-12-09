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
                <th>休憩時間</th>
            </tr>
        </thead>
        <tbody>
            @foreach($staff->attendanceinfo as $attendance)
                <tr>
                    <td>{{ $attendance->workingdate }}</td>
                    <td>{{ $attendance->starttime }}</td>
                    <td>{{ $attendance->endtime }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>