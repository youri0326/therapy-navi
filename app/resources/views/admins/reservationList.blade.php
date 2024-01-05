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
		<h1 align="center" style="margin-top: 21px;">予約一覧画面【管理者】</h1>
		<hr align="center" size="5" color="BLUE" width="950"></hr>
        <a>予約一覧</a>
        <!-- 予約一覧 -->
        <div id="main" class="container">
            <hr></hr>
                <table class="table">
                    <thead>
                        <tr>
                            <th>予約番号</th>
                            <th>予約店舗</th>
                            <th>予約日</th>
                            <th>予約時間</th>
                            <th>支払い状況</th>
                            <th>メニュー</th>
                            <th>支払方法</th>
                            <th>追記事項</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservationList as $reserve)
                        <!-- 予約店舗情報を表示 -->
                        @php
                            // 予約に関連する店舗情報を取得
                            $store = $storeList->where('storeid', $reserve->storemenuinfo->storeid)->first();
                            // 予約に関連するメニュー情報を取得
                            $menu = $storemenuList->where('storemenuid', $reserve->storemenuid)->first();
                        @endphp
                        <tr>
                            <td>
                                #{{ $loop->iteration }}
                            </td>
                            <td>
                                @if($store) <!-- $storeが存在する場合 -->
                                    {{ $store->storename }}
                                @else <!-- $storeが存在しない場合 -->
                                    店舗が存在しません
                                @endif
                            </td>
                            <td>{{$reserve->reservedate}}</td>
                            <td>{{$reserve->reservetime}}</td>
                            <td>{{$menu->servicename}}</td>
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
                            <td>
                                @if($reserve->status == 0)
                                    店舗でお支払い
                                @elseif($reserve->status == 1)
                                    お支払済み
                                @else

                                @endif
                            </td>
                            <td>{{$reserve->addcomment}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
	</body>
</html>