{{--
    プログラム名		：reservationList.blade.php
    プログラム説明	：予約一覧画面

--}}

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<title>List</title>
	</head>
	<body>
		<h1 align="center" style="margin-top: 21px;">予約一覧画面</h1>
		<hr align="center" size="5" color="BLUE" width="950"></hr>
        <a>{{$customerList->name}}さんの予約状況</a>
        <!-- 予約一覧 -->
        <div id="main" class="container">
            @foreach($reservationList as $reserve)
            <hr></hr>
                <table class="input-table">
                    <thead>
                        <tr>
                            <th>予約番号</th><td>#{{ $loop->iteration }}</td>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- 予約店舗情報を表示 -->
                        @php
                            // 予約に関連する店舗情報を取得
                            $store = $storeList->where('storeid', $reserve->storemenuinfo->storeid)->first();
                        @endphp
                        <tr>
                            <th>予約店舗</th>
                            <td>
                                @if($store) <!-- $storeが存在する場合 -->
                                    {{ $store->storename }}
                                @else <!-- $storeが存在しない場合 -->
                                店舗が存在しません
                            @endif
                            </td>
                        </tr>
                        <tr>
                            <th>予約日</th><td>{{$reserve->reservedate}}<td>
                        </tr>
                        <tr>
                            <th>予約時間</th><td>{{$reserve->reservetime}}<td>
                        </tr>
                        <tr>
                            <th>支払方法</th><td>{{$reserve->payment}}</td>
                        </tr>
                        <tr>
                            <th>支払い状況</th><td>{{$reserve->status}}</td>
                        </tr>
                        <tr>
                            <th>追記事項</th><td>{{$reserve->addcomment}}</td>
                        </tr>
                    </tbody>
                </table>
            
            @endforeach
        </div>
	</body>
</html>