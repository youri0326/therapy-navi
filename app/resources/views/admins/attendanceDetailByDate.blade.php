{{--
    プログラム名		：.blade.php
    プログラム説明	：
    作成日時			：
    作成者			：吉池悠理
--}}
@php
function getAttendanceStatus($staff, $selectedDate, $hour) {
    // 指定した日付と時間に対応する勤怠情報を検索
    $attendance = $staff->attendinfo->first();
    $attDate = new DateTime($attendance->workingdate);

    $starttime = DateTime::createFromFormat('H:i:s', $attendance->starttime)->format('H');
    $endtime = DateTime::createFromFormat('H:i:s', $attendance->endtime)->format('H');
    $breakstart = DateTime::createFromFormat('H:i:s', $attendance->breakstart)->format('H');
    $breakend = DateTime::createFromFormat('H:i:s', $attendance->breakend)->format('H');

    $exisistence = $attDate->format('Y-m-d') == $selectedDate->format('Y-m-d') &&
                (int)$starttime <= $hour &&
                (int)$endtime > $hour &&
                ((int)$breakstart > $hour || (int)$breakend <= $hour);

    // 勤怠情報があれば〇、なければ×を返す
    return $exisistence ? '〇' : '×';
}
@endphp


<!DOCTYPE html>
<html lang="en">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

		<title>日付別の勤怠詳細情報</title>
	</head>

<body>

    <h2>{{ $selectedDate->format('Y年m月d日') }}の勤怠情報</h2>

    <table>

        <thead>
            <tr>
                <th>時間</th>
                @foreach($store->staffinfo as $staff)
                    <th>{{ $staff->staffname }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>

            @for($hour = 9; $hour <= 22; $hour++)
                    <tr>
                        <td>{{ $hour }}:00</td>
                        @foreach($store->staffinfo as $staff)
                        <td>{{ getAttendanceStatus($staff, $selectedDate, $hour) }}</td>
                        @endforeach              
                    </tr>
            @endfor
        </tbody>
    </table>

</body>
</html>