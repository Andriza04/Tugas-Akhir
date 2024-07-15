@extends('layout.home')
@section('title')
    <title>Ayok diskusi
    </title>
@endsection
@section('header')
  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js/hsli39z7puehvf2y0z8yveor6lnjr4n801nblg3n39gnaovg"></script>
@endsection
@section('content')


<div class="card card-widget">
            <div class="card-header">
                <div class="user-block">
                <img class="img-circle" src="{{$pertanyaan->user->profile->getAvatar()}}" alt="User Image">
                <span class="username"><a href="#">{{$pertanyaan->user->profile->nama_lengkap}}</a></span>
                <span class="description">{{$pertanyaan->created_at->diffForHumans()}}</span>
                </div>
                <!-- /.user-block -->
                <?php $if_null = App\Models\Pertanyaan::where('user_id','=', $pertanyaan->user->id)->first() ?>
                @if ($if_null->user_id==Auth::user()->id || Auth::user()->role === 'admin')
                <div class="card-tools">
                <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle text-dark" data-toggle="dropdown">
                    <i class="fas fa-wrench"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                    <a href="/forum/edit/{{$pertanyaan->id}}" class="dropdown-item">Edit</a>
                    <form action="/forum/hapus/{{$pertanyaan->id}}" method="POST" id="delete-{{ $pertanyaan->id }}">
                        @csrf
                        <input type="submit" value="Hapus" class="dropdown-item btn btn-light btn-sm" id="delete">
                    </form>
                    </div>
                </div>
                </div>
                @else

                @endif
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <!-- post text -->
                <p>{!!$pertanyaan->isi!!}</p>
                <!-- Attachment -->
                <!-- /.attachment-block -->

                <!-- Social sharing buttons -->
                <span class="float-right text-muted">{{$pertanyaan->komentar_pertanyaan->count()}} Komentar</span>
            </div>
            <!-- /.card-body -->
        {{-- {awal komentar --}}
        @foreach ($pertanyaan->komentar_pertanyaan as $komentar)
            <div class="card-footer card-comments">
                <div class="card-comment">
                <!-- User image -->
                <img class="img-circle img-sm" src="{{$komentar->user->profile->getAvatar()}}" alt="User Image">

                <div class="comment-text">
                    <span class="username">
                    {{$komentar->user->profile->nama_lengkap}}
                    <span class="text-muted float-right">{{$komentar->created_at->diffForHumans()}}</span>
                    </span><!-- /.username -->
                    {{$komentar->isi}}
                </div>
                <!-- /.comment-text -->
                </div>
            </div>
        @endforeach
{{-- akhir komentar --}}
            <!-- /.card-footer -->
            <div class="card-footer">
                <form action="/forum/komentar_pertanyaan/{{$pertanyaan->id}}" method="POST">
                @csrf
                <img class="img-fluid img-circle img-sm" src="{{auth()->user()->profile->getAvatar()}}" alt="Alt Text">
                <!-- .img-push is used to add margin to elements next to floating images -->
                <div class="img-push">
                    <input type="text" name="komentar" class="form-control form-control-sm" placeholder="Tekan enter untuk memposting komentar">
                </div>
                </form>
            </div>
            <!-- /.card-footer -->
            </div>



@endsection
@section('footer')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(function() {
      $(document).on('click', '#delete-{{ $pertanyaan->id }}', function(e) {
        e.preventDefault()
        let link = $(this).attr('action')

        Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!"
        }).then((result) => {
          if (result.value) {
            document.getElementById('delete-{{ $pertanyaan->id }}').submit(); // Submit the form if confirmed
          }
        });
      })
    })
  
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

tinymce.init(editor_config);
</script>
@endsection
