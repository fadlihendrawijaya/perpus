@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Daftar Buku 
                    <div class="text-right">
                        <a href="#!" class="btn btn-sm btn-primary text-right" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Tambah Data </a>
                    </div>
                </div>
            </div>
            @if($message = Session::get('status'))
            <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                <p>{{$message}}</p>
            </div>
            @endif
            <div class="panel-body py-3">
                <table id="mytable" class="table table-striped table-hover mytable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $e=>$dt)
            
                        <tr>
                            <td>{{$e+1}}</td>
                            <td>{{$dt->name}}</td>
                            <td>{{$dt->email}}</td>
            
                            <td>
                                <a href="{{url('admin/edit/'.$dt->id)}}" class="btn btn-success btn-sm btn-flat">Edit</a>
                                <a href="{{url('admin/destroy/'.$dt->id)}}" class="btn btn-danger btn-sm btn-flat" onclick="return confirm ('Apakah Akan Anda Hapus?')">Hapus</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="exampleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('admin/create') }}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group {{$errors->has('name') ? 'has-error' :''}}">
                        <label for="exampleFormControlInput1">Nama</label>
                        <input name="name" type="text" class="form-control" id="inputnama" placeholder="Input nama" value="{{old('name')}}">
                        @if($errors->has('name'))
                        <span class="right badge badge-danger" class=" help-block">{{$errors->first('name')}}</span>
                        @endif
                    </div>
                    <div class="form-group {{$errors->has('email') ? 'has-error' :''}}">
                        <label for="email">Username</label>
                        <input name="email" type="email" class="form-control" id="email" placeholder="Input Username" value="{{old('email')}}">
                        @if($errors->has('email'))
                        <span class="right badge badge-danger" class=" help-block">{{$errors->first('email')}}</span>
                        @endif
                    </div>

                    <div class="form-group {{$errors->has('password') ? 'has-error' :''}}">
                        <label for="password">Password</label>
                        <input name="password" type="password" class="form-control" id="password" placeholder="Input Password" autocomplete="on" value="{{old('password')}}">
                        @if($errors->has('password'))
                        <span class="right badge badge-danger" class=" help-block">{{$errors->first('password')}}</span>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa  fa-power-off"></i> Tutup</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">

    $(document).ready(function() {
        $(".preloader").fadeOut();
        $('.mytable').DataTable()
    })
    $(function() {
        $('.select').select({
            tags: true,
            width: '100%'
            // dropdownParent: $('#myModal')
        })
        $('.selectbs4').select({
            theme: 'bootstrap4'
        })


        $(document).ready(function() {
            // $('.sidebar').click(function(e){
            //   $('.preloader').fadeIn();
            // })

            // var flash = "{{ Session::has('sukses') }}";
            // if (flash) {
            //     var pesan = "{{ Session::get('sukses') }}"
            //     swal("Sukses", pesan, "success");
            // }

            // var gagal = "{{ Session::has('gagal') }}";
            // if (gagal) {
            //     var pesan = "{{ Session::get('gagal') }}"
            //     swal("Error", pesan, "error");
            // }

            // var peringatan = "{{ Session::has('peringatan') }}";
            // if (peringatan) {
            //     var pesan = "{{ Session::get('peringatan') }}"
            //     swal("Warning", pesan, "warning");
            // }
            // var info = "{{ Session::has('info') }}";
            // if (info) {
            //     var pesan = "{{ Session::get('info') }}"
            //     swal("Info", pesan, "info");
            // }


            $('body').on('click', '.menu-sidebar', function(e) {
                $('.preloader').fadeIn();
            })

            $('body').on('click', '.btn-refresh', function(e) {
                e.preventDefault();
                $('.preloader').fadeIn();
                location.reload();
            })

            // btn hapus di klik
            $('body').on('click', '.btn-hapus', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                $('#modal-hapus').find('form').attr('action', url);
                $('#modal-hapus').modal();
            });

        });
    })
</script>
@endpush