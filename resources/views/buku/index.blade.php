@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
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
                                <th>Kode</th>
                                <th>ISBN</th>
                                <th>Judul</th>
                                <th>Pengarang</th>
                                <th>Penerbit</th>
                                <th>Tahun Terbit</th>
                                <th>Jumlah Buku</th>
                                <th>Lokasi</th>
                            </tr>
                        </thead>
                    
                        <tbody>
                            @foreach ($data as $e=>$dt)
                    
                            <tr>
                                <td>{{$e+1}}</td>
                                <td>{{$dt->kd_buku}}</td>
                                <td>{{$dt->nama_buku}}</td>
                                <td>{{$dt->penulis}}</td>
                                <td>{{$dt->penerbit}}</td>
                                <td>{{$dt->tahun_terbit}}</td>
                                <td>{{$dt->jml_buku}}</td>
                                <td>{{$dt->deskripsi}}</td>
                                <td>
                                    <a href="{{ url('buku/edit/'. $dt->id) }}"class="btn btn-success btn-sm btn-flat">Edit</a>
                                    <a href="{{url('buku/destroy/'.$dt->id)}}" class="btn btn-danger btn-sm btn-flat" onclick="return confirm ('Apakah Akan Anda Hapus?')">Hapus</a>
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
                <h5 class="modal-title">Tambah Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('buku/create') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group {{ $errors->has('nama_buku') ? 'has-error' : '' }}">
                        <label for="nama_buku">Judul</label>
                        <input name="nama_buku" type="text" class="form-control" id="nama_buku" placeholder="Input judul"
                            value="{{ old('nama_buku') }}">
                        @if ($errors->has('nama_buku'))
                            <span class="right badge badge-danger"
                                class=" help-block">{{ $errors->first('nama_buku') }}</span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group {{ $errors->has('kd_buku') ? 'has-error' : '' }}">
                                <label for="kd_buku">Kode Buku</label>
                                <input name="kd_buku" type="text" class="form-control" id="kd_buku"
                                    readonly value="{{ $kode }}">
                                @if ($errors->has('kd_buku'))
                                    <span class="right badge badge-danger"
                                        class=" help-block">{{ $errors->first('kd_buku') }}</span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('penulis') ? 'has-error' : '' }}">
                                <label for="penulis">Pengarang</label>
                                <input name="penulis" type="text" class="form-control" id="penulis"
                                    placeholder="Input pengarang" value="{{ old('penulis') }}">
                                @if ($errors->has('penulis'))
                                    <span class="right badge badge-danger"
                                        class=" help-block">{{ $errors->first('penulis') }}</span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('penerbit') ? 'has-error' : '' }}">
                                <label for="penerbit">Penerbit</label>
                                <input name="penerbit" type="text" class="form-control" id="penerbit"
                                    placeholder="Input Penerbit" value="{{ old('penerbit') }}">
                                @if ($errors->has('penerbit'))
                                    <span class="right badge badge-danger"
                                        class=" help-block">{{ $errors->first('penerbit') }}</span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('tahun_terbit') ? 'has-error' : '' }}">
                                <label for="tahun_terbit">Tahun Terbit</label>
                                <input name="tahun_terbit" type="text" class="form-control" id="tahun_terbit"
                                    placeholder="Input Tahun Terbit" value="{{ old('tahun_terbit') }}">
                                @if ($errors->has('tahun_terbit'))
                                    <span class="right badge badge-danger"
                                        class=" help-block">{{ $errors->first('tahun_terbit') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group {{ $errors->has('jml_buku') ? 'has-error' : '' }}">
                                <label for="jml_buku">Jumlah Buku</label>
                                <input name="jml_buku" type="text" class="form-control" id="jml_buku"
                                    placeholder="Input Jumlah Buku" value="{{ old('jml_buku') }}">
                                @if ($errors->has('jml_buku'))
                                    <span class="right badge badge-danger"
                                        class=" help-block">{{ $errors->first('jml_buku') }}</span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('deskripsi') ? 'has-error' : '' }}">
                                <label for="exampleFormControlInput1">Deskripsi</label>
                                <input name="deskripsi" type="text" class="form-control" id="inputdeskripsi"
                                    placeholder="Input deskripsi" value="{{ old('deskripsi') }}">
                                @if ($errors->has('deskripsi'))
                                    <span class="right badge badge-danger"
                                        class=" help-block">{{ $errors->first('deskripsi') }}</span>
                                @endif
                            </div>
                        </div>
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