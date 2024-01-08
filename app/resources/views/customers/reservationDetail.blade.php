{{--
    プログラム名		：.blade.php
    プログラム説明	：
    作成日時			：
    作成者			：佐藤泰樹
--}}
<!DOCTYPE html>
<html lang="en">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

		<title>予約詳細情報</title>
    </head>

    <body>
        @foreach($reservationList as $reserve)
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
    </body>
</html>