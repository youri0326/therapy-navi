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
<button class="editBtn">編集</button>
<form action="{{ route('admins.store.photo.insert') }}" method="post" enctype="multipart/form-data" id="form">
@csrf
    <div class="row">
        <div class="dropzone" id="myDropzone">
        @for ($i = 0; $i < 3; $i++)
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        ドラッグ＆ドロップで画像を追加・更新
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="dropzone" id="myDropzone_{{ $i }}">
                                <div class="fallback">
                                    <input type="file" name="photo_{{ $i }}" id="photo_{{ $i }}" />
                                </div>
                            </div>
                            <label class="custom-file-label" id="photo_{{ $i }}-label" for="photo_{{ $i }}">
                            @if($i === 0)
                              メイン画像
                            @else
                              サブ画像{{ $i }}
                            @endif                             
                            </label>
                            <img id="photo_{{ $i }}-preview" src="{{ asset('storage/img/noimage.jpg') }}" alt="No Image" class="img-fluid mt-2">
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
                @if ($store->storephotoinfo[$i])
                    <img src="{{ asset($store->storephotoinfo[$i]->photopath) }}" alt="画像{{$i}}" class="img-fluid">
                @else
                    <img src="{{ asset('storage/img/noimage.jpg') }}" alt="No Image" class="img-fluid">
                @endif
                </div>
              </div>
            </div>
        @endfor
        </div>
    </div>

        <label class="custom-file-label" id="photo-label" for="photo">
    <div class="col-12">
        <button type="submit" class="btn btn-primary" id="submit">更新</button>
    </div>

</form>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>

<script>
// $(document).ready(function() {
$(document).ready(function() {
    // 編集ボタンをクリックしたら登録画面を表示
    $(".editBtn").click(function() {
        alert("test:");
    });
    // Dropzone の初期化
        // Dropzone の初期化
    Dropzone.autoDiscover = false;
//     Dropzone.options.myAwesomeDropzone = {
//         url: "{{ route('admins.store.photo.insert') }}", // ファイルアップロードのためのURLを指定
//         paramName : "file",
//         paralleUploads : 3,
//         acceptedFiles : 'image/*',
//         maxFiles: 3,
//         maxFilesize: 1,
//         autoProcessQueue: false,
//         // uploadMultiple:true,
//         dictFileTooBig: "ファイルが大きすぎます。(@{{filesize}}MB). 最大サイズ: @{{maxFilesize}}MB.",
//         dictInvalidFileType: "画像ファイルのみアップロードが可能です。",
//         dictMaxFilesExceeded: "ファイルは6ファイルまで追加が可能です。",
//         dictDefaultMessage: "ここへファイルをドラッグ＆ドロップするとアップロードされます。<br>最大6ファイルまでアップ可能です。<br><br>（もしくはここをクリックするとファイル選択ウインドウが表示されますのでそこで選択してもアップ可能です）",
//   };
    // if ($("#myDropzone").data("dropzone")) {
    //     $("#myDropzone").data("dropzone").destroy();
    // }
    // var dropzone = new Dropzone("#myDropzone", {
    //     url: "{{ route('admins.store.photo.insert') }}", // ファイルアップロードのためのURLを指定
    //     autoProcessQueue: false, // 手動で処理するために自動処理を無効化
    //     dictDefaultMessage: "ファイルを選択またはドラッグ&ドロップ",
    //     paramName: "photo", // ファイルのパラメータ名
    //     maxFiles: 3, // 1つのファイルに制限
    //     acceptedFiles: 'image/*', // 受け入れるファイルの種類を指定
    // });  

    // Dropzone.autoDiscover = false;
    // if ($("#myDropzone_0").data("dropzone")) {
    //     $("#myDropzone_0").data("dropzone").destroy();
    // }
    // var dropzone0 = new Dropzone("#myDropzone_0", {
    //     url: "{{ route('admins.store.photo.insert') }}", // ファイルアップロードのためのURLを指定
    //     autoProcessQueue: false, // 手動で処理するために自動処理を無効化
    //     dictDefaultMessage: "ファイルを選択またはドラッグ&ドロップ",
    //     paramName: "photo_0", // ファイルのパラメータ名
    //     maxFiles: 3, // 1つのファイルに制限
    //     acceptedFiles: 'image/*', // 受け入れるファイルの種類を指定
    // });  
    // Dropzone.autoDiscover = false;
    // if ($("#myDropzone_1").data("dropzone")) {
    //     $("#myDropzone_1").data("dropzone").destroy();
    // }
    // var dropzone1 = new Dropzone("#myDropzone_1", {
    //     url: "{{ route('admins.store.photo.insert') }}", // ファイルアップロードのためのURLを指定
    //     autoProcessQueue: false, // 手動で処理するために自動処理を無効化
    //     dictDefaultMessage: "ファイルを選択またはドラッグ&ドロップ",
    //     paramName: "photo_1", // ファイルのパラメータ名
    //     maxFiles: 3, // 1つのファイルに制限
    //     acceptedFiles: 'image/*', // 受け入れるファイルの種類を指定
    // });     
    // Dropzone.autoDiscover = false;
    // if ($("#myDropzone_2").data("dropzone")) {
    //     $("#myDropzone_2").data("dropzone").destroy();
    // }
    // var dropzone2 = new Dropzone("#myDropzone_2", {
    //     url: "{{ route('admins.store.photo.insert') }}", // ファイルアップロードのためのURLを指定
    //     autoProcessQueue: false, // 手動で処理するために自動処理を無効化
    //     dictDefaultMessage: "ファイルを選択またはドラッグ&ドロップ",
    //     paramName: "photo_2", // ファイルのパラメータ名
    //     maxFiles: 3, // 1つのファイルに制限
    //     acceptedFiles: 'image/*', // 受け入れるファイルの種類を指定
    // });

    // dropzone1.on("addedfile", function (file) {
    //     // ファイル名を表示する
    //     $("#photo_1-label").text(file.name);
    //     alert(file.name);
    //     file.previewElement.remove();
    //     // プレビュー画像を表示する
    //     var reader = new FileReader();
    //     reader.onload = function (e) {
    //         // $("#photo_" + i + "-preview").attr("src", e.target.result);
    //         $("#photo_0-preview").attr("src", e.target.result);
    //     };
    //     reader.readAsDataURL(file);
        
    // });
    //     // ファイルが正常にアップロードされたときのイベント
    //     dropzone1.on("success", function (file, response) {
    //     // 成功時の処理、必要に応じて実装
    //     alert("ファイルが正常にアップロードされました");
    // });
    //     var dropzones = [];

    for (let i = 0; i < 3; i++) {
        if ($("#myDropzone_"+i).data("dropzone")) {
            $("#myDropzone_"+i).data("dropzone").destroy();
        }
        var dropzone = new Dropzone("#myDropzone_"+i, {
            url: "{{ route('admins.store.photo.insert') }}", // ファイルアップロードのためのURLを指定
            // autoProcessQueue: false, // 手動で処理するために自動処理を無効化
            // dictDefaultMessage: "ファイルを選択またはドラッグ&ドロップ",
            maxFilesize: 1,
            dictDefaultMessage: "ここへファイルをドラッグ＆ドロップするとアップロードされます。<br>最大6ファイルまでアップ可能です。<br><br>（もしくはここをクリックするとファイル選択ウインドウが表示されますのでそこで選択してもアップ可能です）",
            paramName: "photo_" + i, // ファイルのパラメータ名
            // maxFiles: 3, // 1つのファイルに制限
            acceptedFiles: 'image/*', // 受け入れるファイルの種類を指定
        });


        // ファイルが追加されたら、処理を行う
        dropzone.on("addedfile", function(file) {
            alert(file.name);
            file.previewElement.remove();
            // ファイル名を表示する
            $("#" + file.previewTemplate.id + "-label").text(file.name);

            // プレビュー画像を表示する
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#photo_" + i + "-preview").attr("src", e.target.result);
                // $("#photo_" + dropzone.options.index + "-preview").attr("src", e.target.result);
            };
            reader.readAsDataURL(file);

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

        // ファイルが削除されたら、プレビュー画像をリセットする
        dropzone.on("removedfile", function(file) {
            $("#photo_" + i + "-preview").attr("src", "{{ asset('path_to_noimage.jpg') }}");
        });
    }
});

$(function() {
    
    // // Dropzone の初期化
    // var dropzone1 = new Dropzone("#photo_1");

    // dropzone1.on("addedfile", function(file) {
    //     // ファイル名を表示する
    //     $("#photo_1-label").text(file.name);
    //     $("#" + file.previewTemplate.id + "-label").text(file.name);
    //     alert('test:');
    //     alert(file.name);
    //     // this オブジェクトを明示的に渡す
    //     this.on("addedfile", function() {
    //       // プレビュー画像を表示する
    //       var reader = new FileReader();
    //       reader.onload = function (e) {
    //         $("#photo_" + i + "-preview").attr("src", e.target.result);
    //       };
    //       reader.readAsDataURL(file);

    //       // ファイル名を表示する
    //       $("#photo_1-label").text(file.name);
    //     //   $("#" + file.previewTemplate.id + "-label").text(file.name);
    //     });
    // });

    // var dropzones = [];

    // for (let i = 0; i < 3; i++) {
    //     var dropzone = new Dropzone("#photo_" + i);
    //     dropzones.push(dropzone);

    //     // ファイルが追加されたら、処理を行う
    //     dropzone.on("addedfile", function(file) {
    //         // ファイル名を表示する
    //         $("#" + file.previewTemplate.id + "-label").text(file.name);

    //         // プレビュー画像を表示する
    //         var reader = new FileReader();
    //         reader.onload = function (e) {
    //             // $("#photo_" + i + "-preview").attr("src", e.target.result);
    //             $("#photo_" + dropzone.options.index + "-preview").attr("src", e.target.result);
    //         };
    //         reader.readAsDataURL(file);

    //         // ファイルの種類を取得する
    //         var type = file.type;

    //         // バリデーションを行う
    //         if (type !== "image/jpeg" && type !== "image/png") {
    //             // エラーメッセージを表示する
    //             alert("画像のファイル形式が正しくありません。");

    //             // ファイルを削除する
    //             file.remove();
    //         }
    //     });

    //     // ファイルが削除されたら、プレビュー画像をリセットする
    //     dropzone.on("removedfile", function(file) {
    //         $("#photo_" + i + "-preview").attr("src", "{{ asset('path_to_noimage.jpg') }}");
    //     });
    // }
});



</script>

@endsection