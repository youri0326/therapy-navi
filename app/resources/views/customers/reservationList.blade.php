{{--
    プログラム名		：reservationList.blade.php
    プログラム説明	：予約一覧画面

--}}

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<title>予約一覧</title>
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
                            // 予約に関連するメニュー情報を取得
                            $menu = $storemenuList->where('storemenuid', $reserve->storemenuid)->first();
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
                            <th>メニュー</th><td>{{$menu->servicename}}</td>
                        </tr>
                        <tr>
                            <th>支払方法</th>
                            <!-- paymentに基づいて表示を切り替え -->
                            <td>
                                @if($reserve->payment == 0)
                                    現金
                                @elseif($reserve->payment == 1)
                                    クレジットカード
                                @elseif($reserve->payment == 2)
                                    バーコード決済
                                @else
                                    その他
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>支払い状況</th>
                            <td>
                                @if($reserve->status == 0)
                                    店舗でお支払い
                                @elseif($reserve->status == 1)
                                    お支払済み
                                @else

                                @endif
                            </td>
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