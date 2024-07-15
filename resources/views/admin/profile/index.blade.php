@extends('layout.main')

@section('title')
    <h1>DATA TABLE PROFILE USER</h1>
@endsection
@section('content')
    <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th style="width: 10px">no</th>
                        <th>username</th>
                        <th>nama profile</th>
                        <th>email</th>
                        <th>Role</th>
                        <th style="width: 280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($user as $pro)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$pro->name}}</td>
                        <td>{{$pro->profile->nama_lengkap}}</td>
                        <td>{{$pro->email}}</td>
                        <td>{{$pro->role}}</td>
                        <td class="justify-content-center d-flex">
                            {{-- <a href="profile/{{$pro->id}}" class="btn  btn-success">SHOW</a> --}}
                            <a href="profile/{{ $pro->id }}/edit" class="btn  btn-primary">Edit Akun</a>
                            <form action="profile/{{ $pro->id }}" method="POST" class="d-inline" id="delete-{{ $pro->id }}">
                                @method('delete')
                                @csrf
                            <button  class="submit btn badge-danger">Hapus Akun</button>
                            </form>
                        </td>
                    @endforeach

                        </tr>
                    </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right text-secondary">
                    {{$user->links()}}
                    </ul>
                </div>
                </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
    
        <div class="modal-body">
        <form action="profile" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">username</label>
            <input type="text" class="form-control  @error('username') is-invalid @enderror" name="username" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukan nama profile">
            @error('username')
            <div class="invalid-feedback mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">nama profile</label>
            <input type="text" class="form-control  @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukan nama profile">
            @error('nama_lengkap')
            <div class="invalid-feedback mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">email</label>
            <input type="text" class="form-control  @error('email') is-invalid @enderror" name="email" id="exampleInputPassword1" placeholder="Masukan pertanyaan">
            @error('email')
            <div class="invalid-feedback mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">password</label>
            <input type="text" class="form-control  @error('password') is-invalid @enderror" name="password" id="exampleInputPassword1" placeholder="masukan judul">
            @error('password')
            <div class="invalid-feedback mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Foto</label>
            <input type="file" class="form-control  @error('foto') is-invalid @enderror" name="foto" id="exampleInputPassword1" placeholder="masukan judul">
            @error('foto')
            <div class="invalid-feedback mt-2">{{ $message }}</div>
            @enderror
        </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">back</button>
            <button type="submit" class="btn btn-primary">simpan</button>
        </div>
        </form>
        </div>
    </div>
    </div>
@endsection
@section('footer')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(function() {
      $(document).on('click', '#delete-{{ $pro->id }}', function(e) {
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
            document.getElementById('delete-{{ $pro->id }}').submit(); // Submit the form if confirmed
          }
        });
      })
    })
  
</script>
@endsection