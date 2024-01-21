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
                                    <!-- <input type="file" name="photo_{{ $i }}" id="photo_{{ $i }}" /> -->
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
        <button type="submit" class="btn btn-primary" >更新</button>
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
    Dropzone.autoDiscover = false;


    // Dropzone インスタンスを格納する配列
    var dropzones = [];

    for (let i = 0; i < 3; i++) {
        if ($("#myDropzone_"+i).data("dropzone")) {
            $("#myDropzone_"+i).data("dropzone").destroy();
        }
        var dropzone = new Dropzone("#myDropzone_"+i, {
            url: "{{ route('admins.store.photo.insert') }}", // ファイルアップロードのためのURLを指定
            autoProcessQueue: false, // 手動で処理するために自動処理を無効化
            maxFilesize: 1,
            parallelUploads: 1,
            uploadMultiple: false,
            dictDefaultMessage: "ここへファイルをドラッグ＆ドロップするとアップロードされます。<br>最大6ファイルまでアップ可能です。<br><br>（もしくはここをクリックするとファイル選択ウインドウが表示されますのでそこで選択してもアップ可能です）",
            paramName: "photo_" + i, // ファイルのパラメータ名
            autoRemoveFileInput: false,
            acceptedFiles: 'image/*', // 受け入れるファイルの種類を指定
        });
        dropzones.push(dropzone); // Dropzone インスタンスを配列に追加

        // ファイルが追加されたら、処理を行う
        dropzone.on("addedfile", function(file) {
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
            // else{
            //     $("input[name='photo_" + i + "']").val(file.name);
            // }
        });

        // ファイルが削除されたら、プレビュー画像をリセットする
        dropzone.on("removedfile", function(file) {
            $("#photo_" + i + "-preview").attr("src", "{{ asset('storage/img/noimage.jpg') }}");
        });
    }
    // フォーム送信時の処理
    $("#form").submit(function(e) {
        e.preventDefault(); // 通常のフォーム送信を防ぐ

        // FormData オブジェクトを作成
        var formData = new FormData();

        // 各Dropzoneのキューにあるファイルを処理
        // dropzones.forEach(function(dropzone, index) {
        //     var files = dropzone.files;

        //     alert(files);
        //     alert(files.name);
        //     formData.append("photo_" + index + "[" + fileIndex + "]", file);

        //     // ファイルのデータを FormData に追加
        //     files.forEach(function(file, fileIndex) {
        //         alert(file.name);
        //         formData.append("photo_" + index + "[" + fileIndex + "]", file);
        //     });
        // });
        // フォームに追加のデータを FormData に追加（例えば _token）
        formData.append("_token", $("input[name='_token']").val());

        // ファイルのデータをフォームに追加
        for (let i = 0; i < 3; i++) {
            var dropzone = dropzones[i];
            var fileList = dropzone.files;
            var file = fileList[0];
            formData.append("photo_" + i, file);
            alert("test:"+file.name);
            // $("#photo_" + i).val(file);
            // dropzone.processQueue();
        }
        axios.post("{{ route('admins.store.photo.insert') }}", formData)
            .then(function(response) {
                console.log(response);
                window.location.href = "{{ route('admins.store.photo.insert') }}"; 
            })
            .catch(function(error) {
                console.log(error);
            });
        // this.submit();
        // // 各Dropzoneのキューにあるファイルを処理
        // dropzones.forEach(function(dropzone) {
        //     // ファイルのデータを取得
        //     var files = dropzone.files;

        //     // axios.post でデータを送信する
        //     axios.post("{{ route('admins.store.photo.insert') }}", {
        //     "photo_0": files[0],
        //     "photo_1": files[1],
        //     "photo_2": files[2],
        //     })
        //     .then(function(response) {
        //         console.log(response);
        //         // // 別のページに遷移する
        //         // window.location.href = "{{ route('admins.store.photo.insert') }}";
        //     })
        //     .catch(function(error) {
        //         console.log(error);
        //     });

        // });
        this.submit();
        
    });
});




</script>

@endsection