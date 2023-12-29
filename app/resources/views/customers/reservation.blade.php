
{{--
    プログラム名		：.blade.php
    プログラム説明	：顧客側ページ

--}}
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<title>List</title>
	</head>
	<body>
        <div class="container">
            <h2>予約画面</h2>
            <form method="post" action="{{ route('reservation.confirm') }}">
                @csrf
                <p>店舗名: {{ $storeinfo->storename }}</p>

                <input type="hidden" name="reservation_datetime" id="reservationDatetime">
                <input type="hidden" name="staffid" id="staffid">
                <input type="hidden" name="staffid" value="{{ $storeinfo->storename }}">


                <table class="table">
                    <thead>
                        <tr>
                            <th>時間</th>
                            @foreach ($dates as $date)
                                <th>{{ $date->format('m-d') }} ({{ $date->shortEnglishDayOfWeek }})</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @for ($hour = 9; $hour <= 22; $hour++)
                            <tr>
                                <td>{{ $hour }}:00</td>
                                @foreach ($dates as $date)
                                    <td>
                                        @if ($availability[$date->format('Y-m-d')][$hour])
                                            〇
                                        @else
                                            ×
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endfor
                    </tbody>
                </table>

                <button type="submit" class="btn btn-primary">予約確認</button>
            </form>
            <script>
                document.querySelectorAll('td').forEach(function(td) {
                    td.addEventListener('click', function() {
                        if (this.textContent === '〇') {
                            var dateTime = this.getAttribute('data-datetime');
                            var staffId = this.getAttribute('data-staffid');
                            document.getElementById('reservationDatetime').value = dateTime;
                            document.getElementById('staffid').value = staffId;
                            document.getElementById('reservationForm').submit();
                        }
                    });
                });
            </script>
        </div>

    </body>