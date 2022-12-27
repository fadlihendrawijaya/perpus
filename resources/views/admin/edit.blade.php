@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card-body">
                        <!-- Konten -->
                        <form action="{{ url('admin/update/'.$data->id) }}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group {{$errors->has('name') ? 'has-error' :''}}">
                                <label for="name">Nama</label>
                                <input name="name" type="text" class="form-control" id="name" placeholder="Input Nama" value="{{$data->name}}">
                                @if($errors->has('name'))
                                <span class="right badge badge-danger" class=" help-block">{{$errors->first('name')}}</span>
                                @endif
                            </div>
            
                            <div class="form-group {{$errors->has('email') ? 'has-error' :''}}">
                                <label for="email">Username</label>
                                <input name="email" type="text" class="form-control" id="email" placeholder="Input Username" value="{{$data->email}}">
                                @if($errors->has('email'))
                                <span class="right badge badge-danger" class=" help-block">{{$errors->first('email')}}</span>
                                @endif
                            </div>
            
                            <div class="form-group {{$errors->has('password') ? 'has-error' :''}}">
                                <label for="password">password</label>
                                <input name="password" type="password" class="form-control" id="password" placeholder="Input password" autocomplete="on" value="{{$data->password}}">
                                @if($errors->has('password'))
                                <span class="right badge badge-danger" class=" help-block">{{$errors->first('password')}}</span>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Perubahan</button>
                            </div>
                        </form>
                        <!-- Konten End -->
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
        })
        $('.selectbs4').select({
            theme: 'bootstrap4'
        })


        $(document).ready(function() {
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