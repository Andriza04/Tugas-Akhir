@extends('layout.home')
@section('header')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js/hsli39z7puehvf2y0z8yveor6lnjr4n801nblg3n39gnaovg"></script>
@endsection
@section('content')
    <section class="card" style="background: #29b6f6;">
        <div class="card-header">
            <h3 class="card-title text-dark">Masukkan pertanyaan anda</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="/forum/store" name="form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                 <div class="form-group">
                     <label for="judul">Masukkan judul</label>
                    <input type="text" required class="form-control  @error('judul') is-invalid @enderror" name="Judul" placeholder="masukkan judul" id="judul">
                </div>
                <div class="form-group">
                        <label for="exampleInputPassword1">Masukkan pertanyaan anda</label>
                        <textarea name="isi" id="isi" required class="form-control my-editor"></textarea>
                        @error('isi')
                        <div class="invalid-feedback mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                <div class="form-group">
                    <label for="tags">Hashtag</label>
                    <input type="text" class="form-control" id="tags" requied name="tags">
                </div>
                <a href="/" type="submit" class="btn btn-light mt-3">Kembali</a>
                <button type="submit" class="btn btn-light mt-3" id="create">Kirim</button>
            </div>
            <!-- /.card-body -->
        </form>
    </section>
@endsection
@section('footer')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var editor_config = {
        path_absolute : "/",
        selector: "textarea.my-editor",
        plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        file_browser_callback : function(field_name, url, type, win) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
        if (type == 'image') {
            cmsURL = cmsURL + "&type=Images";
        } else {
            cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.open({
            file : cmsURL,
            title : 'Filemanager',
            width : x * 0.8,
            height : y * 0.8,
            resizable : "yes",
            close_previous : "no"
        });
        }
    };
    
    $(function() {
        $(document).on('click', '#create', function(e) {
            let link = $(this).attr('action')
            Swal.fire({
                title: "Berhasil!",
                text: "Menu berhasil di buat",
                icon: "success"
            }).then((result) => {
                if (result.value) {
                    document.getElementById('create').submit(); // Submit the form if confirmed
                }
            });
        })
    })

    tinymce.init(editor_config);
    </script>
@endsection
