
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
            <form method="post" action="{{route('customers.reservation.confirm')}}" id="reservationForm">
                @csrf
                <p>店舗名: {{ $storeinfo->storename }}</p>
                @if ($staff !== null)
                    <p>スタッフ名: {{ $staff->staffname }}</p>
                    <input type="hidden" name="staffid" value="{{$staff->staffid}}">
                @endif
                <input type="hidden" name="reservation_datetime" id="reservationDatetime">
                <input type="hidden" name="storeid" value="{{ $storeinfo->storeid}}">
                <input type="hidden" name="storemenuid" value="{{ $storemenuinfo->storemenuid}}">
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
                                            <span class="available-slot" data-datetime="{{ $date->format('Y-m-d') }} {{ $hour }}:00" >〇</span>
                                        @else
                                            ×
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endfor
                    </tbody>
                </table>

            </form>
            <script>

                // クリック可能なスロットのイベントリスナーを設定
                document.querySelectorAll('.available-slot').forEach(function(slot) {
                    slot.addEventListener('click', function() {
                        var dateTime = this.getAttribute('data-datetime');
                        document.getElementById('reservationDatetime').value = dateTime;
                        document.getElementById('reservationForm').submit();
                    });
                });
            </script>
        </div>

    </body>