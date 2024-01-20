{{--
    プログラム名		：.blade.php
    プログラム説明	：会員登録確認画面

--}}
@extends('customers.layouts.app')

@section('title', '会員登録確認画面')

@section('content')
    <h2>会員登録確認画面</h2>

    <form method="post" action="{{ route('customers.registration.insert') }}">
        @csrf
        <p>お名前: {{ $customer->name}}</p>
        <input type="hidden" name="name" value="{{$customer->name}}">
        <p>ふりがな: {{ $customer->furigana}}</p>
        <input type="hidden" name="furigana" value="{{$customer->furigana}}">
        <p>ログインID: {{ $user->loginid}}</p>	
        <input type="hidden" name="loginid" value="{{$user->loginid}}">
        <p>パスワード: {{ $user->password}}</p>	
        <input type="hidden" name="password" value="{{$user->password}}">
        <p>メールアドレス: {{ $user->email}}</p>
        <input type="hidden" name="email" value="{{$user->email}}">
        <p>電話番号: {{ $user->phone}}</p>
        <input type="hidden" name="phone" value="{{$user->phone}}">
        <p>生年月日: {{ $customer->birthday}}</p>
        <input type="hidden" name="birthday" value="{{$customer->birthday}}">
        <p>住所: {{ $customer->address}}</p>
        <input type="hidden" name="address" value="{{$customer->address}}">

        <button type="submit" class="btn btn-success">確定</button>
    </form>
@endsection
