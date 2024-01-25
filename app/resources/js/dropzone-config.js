// public/js/dropzone-config.js
$(document).ready(function() {
    // Dropzone の初期化
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("#my-dropzone", {
        url: "/upload", // アップロード先のルートを指定
        addRemoveLinks: true,
        acceptedFiles: 'image/*', // 受け入れるファイルタイプを指定
        maxFilesize: 2, // 最大ファイルサイズ（MB）を指定
        parallelUploads: 1, // 並行アップロード数を指定
        // 必要に応じて追加の構成オプションを追加
    });

    myDropzone.on("success", function(file, response) {
        // アップロード成功時の処理
        console.log(response);
    });

    myDropzone.on("error", function(file, errorMessage) {
        // アップロードエラー時の処理
        console.error(errorMessage);
    });

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

        // フォーム送信時の処理
        $("#submit_"+i).click(function(e) {
            e.preventDefault(); // 通常のフォーム送信を防ぐ

            var fileList = dropzones[i].files;
            var file = fileList[0];
            if (file) {
                // 各Dropzoneのキューにあるファイルを処理
                submitForm(e,i,file);
            }else{
                alert("画像を選択してください。");
            }

        });
    }

});

function submitForm(event,index,file) {
    // FormData オブジェクトを作成
    var formData = new FormData();
    formData.append("_token", $("input[name='_token']").val());
    formData.append("photo", file);
    formData.append("imgrole",index);

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
            alert("成功");
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
