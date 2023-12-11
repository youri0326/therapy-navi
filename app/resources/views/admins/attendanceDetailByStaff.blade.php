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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

		<title>スタッフの勤怠詳細情報</title>
	</head>

<body>

    <h2>{{ $staff->staffname }}の{{ $selectedDate->format('Y年m月') }}の勤怠情報</h2>

    <table>
        <thead>
            <tr>
                <th rowspan="2">日付</th>
                <th colspan="2">勤務時間</th>
                <th colspan="2">休憩時間</th>
                <th rowspan="2"></th>
            </tr>
            <tr>
                <th>出勤</th>
                <th>退勤</th>
                <th>開始</th>
                <th>終了</th>
            </tr>
        </thead>
        <tbody>
        @for($day = 1; $day <= $selectedDate->daysInMonth; $day++)
            @php
                $date = $selectedDate->copy()->day($day)->format('Y-m-d');
                $attendance = $staff->attendinfo->firstWhere('workingdate', $date);
            @endphp
            
                <tr>
                    <div class="calendar-day"><td><div class="calendar-day"><span class="date">{{$day}}</span>日</div></td>
                    @if (!empty($attendance))
                        <td>
                            {{substr($attendance->starttime, 0, 5)}}
                        </td>
                        <td>
                            {{substr($attendance->endtime, 0, 5)}}
                        </td>
                        <td>
                            {{substr($attendance->breakstart, 0, 5)}}
                        </td>
                        <td>
                            {{substr($attendance->breakend, 0, 5)}}
                        </td>                        
                    @else
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>                        
                    @endif
                        <td><button class="editBtn">編集</button></td>
                </tr>
        @endfor
        </tbody>
    </table>
    <!-- ポップアップ用のモーダル -->
    <div id="attendanceModal" class="modal">
        <div class="modal-content">
            <span>{{ $selectedDate->month }}/<span id="selectedDate"></span>勤怠登録・更新</span>
            <button id="closeBtn">Close</button>
            <!-- 登録・更新用のフォーム -->
            <form id="attendanceForm">
                <input type="time" id="starttime" placeholder="開始時間">
                <input type="time" id="endtime" placeholder="終了時間">
                <input type="time" id="breakstart" placeholder="休憩開始時間">
                <input type="time" id="breakend" placeholder="休憩終了時間">
                <input type="hidden" id="workingdate" placeholder="勤務日" value~"{{$date}}">
                <input type="hidden" id="sttafid" placeholder="スタッフ" value~"{{$staff->staffid}}">
                <!-- 他のフォーム要素も追加 -->
                <button onclick="closeAndSave()">Submit</button>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // ポップアップを非表示にする
            $('#attendanceModal').hide();

            // 勤務日をマウスオーバーしたらカーソルをポインターに変更
            $('.calendar-day').hover(function() {
                $(this).css('cursor', 'pointer');
            });


            // 編集ボタンをクリックしたら登録画面を表示
            $(document).on('click', '.editBtn', function() {
                var date = $(this).closest('tr').find('.date').text();
                openModal(date);
            });

            // ×ボタンをクリックしたらポップアップを非表示
            $('#closeBtn').click(function() {
                closeAndSave();
            });
        });

        function openModal(date) {
            var modal = document.getElementById('attendanceModal');
            modal.style.display = 'block';

            // モーダル内に日付を表示
            document.getElementById('selectedDate').innerText = date;
        }

        function closeAndSave() {
            var modal = document.getElementById('attendanceModal');
            modal.style.display = 'none';
            // ... (以前のデータ送信処理)
        }

        function saveAttendance() {
            var starttime = document.getElementById('starttime').value;
            var endtime = document.getElementById('endtime').value;
            var breakstart = document.getElementById('breakstart').value;
            var breakend = document.getElementById('breakend').value;
            var workingdate = document.getElementById('workingdate').value;
            var sttafid = document.getElementById('sttafid').value;

            // Ajaxを使用してサーバーにデータを送信
            $.ajax({
                url: '/admins/attendanceInsert', // データを送信するエンドポイント
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    starttime: starttime,
                    endtime: endtime,
                    breakstart: breakstart,
                    breakend: breakend,
                    workingdate: workingdate,
                    sttafid: sttafid
                    // 他のフォームデータを追加
                }),
                success: function(response) {
                    // 成功時の処理を記述
                },
                error: function(xhr, status, error) {
                    // エラーハンドリングを記述
                }
            });
        }
    </script>
</body>
</html>