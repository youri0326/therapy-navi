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
                <th>日付</th>
                <th>出勤時間</th>
                <th>退勤時間</th>
                <th></th>
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
                    @else
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
                <input type="text" id="starttime" placeholder="開始時間">
                <input type="text" id="endtime" placeholder="終了時間">
                <input type="hidden" id="endtime" placeholder="勤務日" value~"{{$date}}">
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
            var selectedDate = document.getElementById('selectedDate').innerText;
            var workHours = document.getElementById('workHours').value;
            var attendanceStatus = document.getElementById('attendanceStatus').value;

            // Ajaxを使用してサーバーにデータを送信
            $.ajax({
                url: '/admins/attendanceInsert', // データを送信するエンドポイント
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    date: selectedDate,
                    workHours: workHours,
                    attendanceStatus: attendanceStatus
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