{{--
    プログラム名		：.blade.php
    プログラム説明	：予約確認画面

--}}

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<title>予約一覧</title>
	</head>
	<body>
		<h1 align="center" style="margin-top: 21px;">予約確認画面</h1>
		<hr align="center" size="5" color="BLUE" width="950"></hr>
        <div class="container">
            <h2>予約確認</h2>
            @php
                if($staff !== null){
                    $staffid = $staff->staffid;
                } 
            @endphp
            <form method="post" action="{{asset('/customers/reservation/insert')}}">
                @csrf
                <p>予約日時: {{ $reservation_datetime}}</p>
                @if ($staff !== null)
                    <p>スタッフ名: {{ $staff->staffname }}</p>
                    <input type="hidden" name="staffid" value="{{$staff->staffid}}">
                @endif
                <p>予約サービス名: {{ $storemenuinfo->servicename }}</p>
                <p>サービス詳細: {{ $storemenuinfo->description }}</p>
                <p>金額: {{ $storemenuinfo->amount }}円</p>
                <p>サービス時間: {{ $storemenuinfo->servicetime }}分</p>
                <p>店舗名: {{ $storeinfo->storename  }}</p>
                <input type="hidden" name="reservation_datetime" value="{{ $reservation_datetime}}">
                <input type="hidden" name="storeid" value="{{ $storeinfo->storeid}}">
                <input type="hidden" name="storemenuid" value="{{ $storemenuinfo->storemenuid}}">
                <p>店舗へのコメント・要望</p>
                <input type="textarea" name="addcomment">

                <button type="submit" class="btn btn-success">確定</button>
            </form>
        </div>
	</body>
</html>
