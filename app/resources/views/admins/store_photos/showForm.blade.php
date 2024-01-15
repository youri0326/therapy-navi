{{--
    プログラム名		：customers.registration.showForm.blade.php
    プログラム説明	：顧客側トップページ

--}}
@extends('customers.layouts.app')

@section('title', '会員登録')

@section('content')
@if(session('error'))
  <p>{{ session('error') }}</p>
@endif
<form action="{{ route('admins.store.photo.insert', ['storeid' => $store->storeid]) }}" method="post" enctype="multipart/form-data" id="form">

<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        ドラッグ＆ドロップで画像を追加・更新
      </div>
      <div class="card-body">
        <div class="form-group">
          <input type="file" name="photo_0" class="form-control dropzone" id="photo_0">
          <label class="custom-file-label" for="photo_0">メイン画像</label>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        既存画像
      </div>
      <div class="card-body">
      @if ($store->storephotoinfo[0])
          <img src="{{ asset($store->storephotoinfo[1]->photopath) }}" alt="既存サブ1画像" class="img-fluid">
      @else
          <p>なし</p>
      @endif
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        ドラッグ＆ドロップで画像を追加・更新
      </div>
      <div class="card-body">
        <div class="form-group">
          <input type="file" name="photo_1" class="form-control dropzone" id="photo_1">
          <label class="custom-file-label" for="photo_1">サブ1画像</label>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        既存画像
      </div>
      <div class="card-body">
        @if ($store->storephotoinfo[1])
          <img src="{{ asset($store->storephotoinfo[1]->photopath) }}" alt="既存サブ1画像" class="img-fluid">
        @else
          <p>なし</p>
        @endif
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        ドラッグ＆ドロップで画像を追加・更新
      </div>
      <div class="card-body">
        <div class="form-group">
          <input type="file" name="photo_2" class="form-control dropzone" id="photo_2">
          <label class="custom-file-label" for="photo_2">サブ2画像</label>
          
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        既存画像
      </div>
      <div class="card-body">
        @if ($store->storephotoinfo[2])
          <img src="{{ asset($store->storephotoinfo[2]->photopath) }}" alt="既存サブ2画像" class="img-fluid">
        @else
          <p>なし</p>
        @endif
      </div>
    </div>
  </div>
</div>

<div class="col-12">
  <button type="submit" class="btn btn-primary" id="submit">更新</button>
</div>
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>

<script>
$(function() {
  // Dropzone の初期化
  var dropzone = new Dropzone("#photo_0");
  var dropzone2 = new Dropzone("#photo_1");
  var dropzone3 = new Dropzone("#photo_2");

  // ファイルが追加されたら、処理を行う
  dropzone.on("addedfile", function(file) {
    // ファイル名を表示する
    $("#photo_0-label").text(file.name);

    // ファイルの種類を取得する
    var type = file.type;

    // バリデーションを行う
    if (type !== "image/jpeg" && type !== "image/png") {
      // エラーメッセージを表示する
      alert("画像のファイル形式が正しくありません。");

      // ファイルを削除する
      file.remove();
    }
  });

  dropzone2.on("addedfile", function(file) {
    // ファイル名を表示する
    $("#photo_1-label").text(file.name);

    // ファイルの種類を取得する
    var type = file.type;

    // バリデーションを行う
    if (type !== "image/jpeg" && type !== "image/png") {
      // エラーメッセージを表示する
      alert("画像のファイル形式が正しくありません。");

      // ファイルを削除する
      file.remove();
    }
  });

  dropzone3.on("addedfile", function(file) {
    // ファイル名を表示する
    $("#photo_2-label").text(file.name);

    // ファイルの種類を取得する
    var type = file.type;

    // バリデーションを行う
    if (type !== "image/jpeg" && type !== "image/png") {
      // エラーメッセージを表示する
      alert("画像のファイル形式が正しくありません。");

      // ファイルを削除する
      file.remove();
    }
  });

  // 更新ボタンをクリックしたら、処理を行う
  $("#submit").click(function() {
    // バリデーション
    var formData = new FormData($("#form")[0]);

    // 画像のファイル形式が正しくない場合、エラーメッセージを表示する
    for (var i = 0; i < dropzone.files.length; i++) {
      var type = dropzone.files[i].type;
      if (type !== "image/jpeg" && type !== "image/png") {
        alert("画像のファイル形式が正しくありません。");
        return false;
      }
    }

    for (var i = 0; i < dropzone2.files.length; i++) {
      var type = dropzone2.files[i].type;
      if (type !== "image/jpeg" && type !== "image/png") {
        alert("画像のファイル形式が正しくありません。");
        return false;
      }
    }

    for (var i = 0; i < dropzone3.files.length; i++) {
      var type = dropzone3.files[i].type;
      if (type !== "image/jpeg" && type !== "image/png") {
        alert("画像のファイル形式が正しくありません。");
        return false;
      }
    }

    // データベースへの保存
    axios.post("{{ route('admins.store.photo.insert', ['storeid' => $store->storeid]) }}", formData)
      .then(function(response) {
        if (response.status == 200) {
          // 成功メッセージの表示
          alert("店舗写真を追加・更新しました。");

          // フォームの再読み込み
          location.reload();
        } else {
          // エラーメッセージの表示
          alert("エラーが発生しました。");
        }
      })
      .catch(function(error) {
        // エラーメッセージの表示
        alert("エラーが発生しました。");
      });
  });
});



</script>

@endsection