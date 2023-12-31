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
            @if ($saveStatus === 1)
            <h2>予約完了</h2>
            <p>予約登録が次の内容で無事成功しました。</p>
            <h3>予約情報一覧</h3>
            <p>予約日時: {{ $reservation_datetime}}</p>
            <p>予約サービス名: {{ $storemenuinfo->servicename }}</p>
            <p>サービス詳細: {{ $storemenuinfo->description }}</p>
            <p>担当スタッフ: {{ $staff->staffname }}</p>
            <p>金額: {{ $storemenuinfo->amount }}円</p>
            <p>サービス時間: {{ $storemenuinfo->servicetime }}分</p>
            <p>店舗名: {{ $storeinfo->storename  }}</p>
            <p>店舗へのコメント・要望：{{ $addcomment }}</p>
            @else
            <h2>予約未完了</h2>
            <p>予約登録が失敗しました。お手数ですが、再度予約手続きを実行ください。</p>
            @endif

            <a href="{{asset('/customers/storeDetail')}}?storeid={{$storeinfo->storeid}}">店舗トップページに戻る</a>
            <a href="{{asset('/')}}">検索画面に戻る</a>
        </div>
	</body>
</html>
