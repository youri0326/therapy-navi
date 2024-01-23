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

@if(session('s'))
  <p>{{ session('s') }}</p>
@endif

<form method="post" enctype="multipart/form-data" id="form">
<!-- <form method="post" enctype="multipart/form-data" id="form" action="{{ route('admins.store.photo.insert') }}"> -->

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
                @php
                    $storephotoinfo = $store->storephotoinfo->where('imgrole', $i)->first();
                @endphp

                @if ($storephotoinfo)
                    <img src="{{ asset($storephotoinfo->photopath) }}" alt="画像{{$storephotoinfo->imgrole}}" class="img-fluid">
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
        <button type="button" id="submit" class="btn btn-primary" >更新</button>
    </div>

</form>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>

<script>
$(document).ready(function() {
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
        });

        // ファイルが削除されたら、プレビュー画像をリセットする
        dropzone.on("removedfile", function(file) {
            $("#photo_" + i + "-preview").attr("src", "{{ asset('storage/img/noimage.jpg') }}");
        });
    }
        // フォーム送信時の処理
    $("#submit").click(function(e) {
        e.preventDefault(); // 通常のフォーム送信を防ぐ

        // 各Dropzoneのキューにあるファイルを処理
        submitForm(e, dropzones);
    });
});

function submitForm(event,dropzones) {
    // FormData オブジェクトを作成
    var formData = new FormData();
    formData.append("_token", $("input[name='_token']").val());

    // ファイルのデータをフォームに追加
    for (let i = 0; i < 3; i++) {
        var dropzone = dropzones[i];
        var fileList = dropzone.files;
        var file = fileList[0];
        if (file) {
            formData.append("photo_" + i, file);
        }

    }

    // 通常のフォーム送信を防ぐ
    event.preventDefault();

    axios.post("{{ route('admins.store.photo.insert') }}", formData, {
        headers: {
            'Content-Type': 'multipart/form-data',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        method: 'POST',  // ここで小文字の'post'を指定
    })
    .then(function(response) {
        if (response.status === 200) {
            // 正常に登録された場合
            const responseData = response.data;
            console.log(responseData);

            if(!responseData.error){
                //そのままエラーだったらエラーを表示、エラーなければリダイレクトにする
                // window.location.href = "{{ route('admins.storeDetail') }}";
            }
        } else {
            // エラーが発生した場合
            alert("登録に失敗しました。もう一度試してください。");
        }
    })
    // .then(function(response) {
    //     // const responseData = JSON.parse(response.data);
    //     const responseData = response.data;
    //     console.log(responseData);
    //     alert("成功:");
    //     alert(responseData.message);
    //     if(!responseData.error){
    //         //そのままエラーだったらエラーを表示、エラーなければリダイレクトにする
    //         window.location.href = "{{ route('admins.storeDetail') }}";
    //     }
    //     alert(responseData.error);
    // })
    .catch(function(error) {
        alert("登録に失敗しました。もう一度試してください。");
        console.log(error);
    });
}

</script>

@endsection