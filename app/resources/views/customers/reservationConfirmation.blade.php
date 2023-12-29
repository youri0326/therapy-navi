@extends('layouts.app')

@section('content')
<div class="container">
    <h2>予約確認</h2>
    <form method="post" action="{{ route('reservation.store') }}">
        @csrf
        <p>予約日時: {{ $reservationData['reservation_datetime'] }}</p>
        <p>スタッフID: {{ $reservationData['staffid'] }}</p>
        
        <p>予約サービス名: {{ $reservationData['servicename'] }}</p>
        <p>サービス詳細: {{ $reservationData['description'] }}</p>
        <p>サービス時間: {{ $reservationData['servicetime'] }}</p>
        <p>店舗名: {{ $reservationData['storename'] }}</p>

        <input type="hidden" name="reservation_datetime" value="{{ $reservationData['reservation_datetime'] }}">
        <input type="hidden" name="staffid" value="{{ $reservationData['staffid'] }}">
        <!-- その他の隠れたフィールドを追加 -->

        <button type="submit" class="btn btn-success">確定</button>
     </form>
</div>
@endsection
