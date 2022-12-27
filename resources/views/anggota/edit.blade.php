@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card-body">
                        <!-- Konten -->
                        <form action="{{ url('anggota/update/'.$data->id) }}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
        
                            <div class="form-group {{$errors->has('nama_anggota') ? 'has-error' :''}}">
                                <label for="exampleFormControlInput1">Nama</label>
                                <input name="nama_anggota" type="text" class="form-control" id="inputnama" value="{{ $data->nama_anggota }}">
                                @if($errors->has('nama_anggota'))
                                <span class="right badge badge-danger" class=" help-block">{{$errors->first('nama_anggota')}}</span>
                                @endif
                            </div>
                            <div class="form-group {{$errors->has('email') ? 'has-error' :''}}">
                                <label for="email">Username</label>
                                <input name="email" type="email" class="form-control" id="email" value="{{ $data->email }}">
                                @if($errors->has('email'))
                                <span class="right badge badge-danger" class=" help-block">{{$errors->first('email')}}</span>
                                @endif
                            </div>
        
                            <div class="form-group {{$errors->has('password') ? 'has-error' :''}}">
                                <label for="password">Password</label>
                                <input name="password" type="password" class="form-control" id="password" autocomplete="on" value="{{ $data->password }}">
                                @if($errors->has('password'))
                                <span class="right badge badge-danger" class=" help-block">{{$errors->first('password')}}</span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('tempat_lahir') ? 'has-error' : '' }}">
                                <label for="exampleFormControlTextarea1">Tempat Lahir</label>
                                <input name="tempat_lahir" type="text" class="form-control" id="tempat_lahir" value="{{ $data->tempat_lahir }}">
                                @if ($errors->has('tempat_lahir'))
                                    <span class="right badge badge-danger"
                                        class=" help-block">{{ $errors->first('tempat_lahir') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
        
                            <div class="form-group {{ $errors->has('tgl_lahir') ? 'has-error' : '' }}">
                                <label for="exampleFormControlInput1">Tanggal Lahir</label>
                                <input name="tgl_lahir" type="date" class="form-control" id="inputtgl_lahir"
                                    value="{{ $data->tgl_lahir }}">
                                @if ($errors->has('tgl_lahir'))
                                    <span class="right badge badge-danger"
                                        class=" help-block">{{ $errors->first('tgl_lahir') }}</span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('jk_anggota') ? 'has-error' : '' }}">
                                <label for="exampleFormControlSelect1">Pilih Jenis Kelamin</label>
                                <select name="jk_anggota" class="form-control" id="exampleFormControlSelect1">
                                    <option value="">-Pilih-</option>
                                    <option value="L" @if ($data->jk_anggota == 'L') selected @endif>L</option>
                                    <option value="P" @if ($data->jk_anggota == 'P') selected @endif>P</option>
                                </select>
                                @if ($errors->has('jk_anggota'))
                                    <span class="right badge badge-danger"
                                        class=" help-block">{{ $errors->first('jk_anggota') }}</span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }}">
                                <label for="exampleFormControlTextarea1">Alamat</label>
                                <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1"
                                    rows="4">{{ $data->alamat }}</textarea>
                                @if ($errors->has('alamat'))
                                    <span class="right badge badge-danger"
                                        class=" help-block">{{ $errors->first('alamat') }}</span>
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