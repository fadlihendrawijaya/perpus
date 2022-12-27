@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="card-header">Daftar Pengembalian</div>
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
                            <th>Kode Peminjam</th>
                            <th>Nama Anggota</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Denda</th>
                            <th>Status Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $e=>$dt)
                        
                        <tr>
                            <td>{{$e+1}}</td>
                            <td>{{$dt->kd_peminjam}}</td>
                            <td>{{$dt->anggota->nama_anggota}}</td>
                            <td>{{$dt->buku->nama_buku}}</td>
                            <td>{{$dt->tgl_pinjam}}</td>
                            <td>{{$dt->tgl_kembali}}</td>
                            <td>
                                @if ($dt->status == 'proses')
                                <span class="badge badge-info">Proses</span>
                                @elseif($dt->status =='pinjam')
                                <span class="badge badge-primary">Dipinjam</span>
                                @elseif($dt->status =='kembali')
                                <span class="badge badge-success">Kembali</span>
                                @elseif($dt->status =='rusak')
                                <span class="badge badge-danger">Rusak</span>
                                @elseif($dt->status =='hilang')
                                <span class="badge badge-warning">Hilang</span>
                                @else
                                <span class="badge badge-warning">Ditolak</span>
                                @endif
                            </td>
                            <td>Rp. {{ number_format($dt->denda) }}</td>
                            <td>
                                @if($dt->status=='pinjam')
                                <a href="{{url('pengembalian/kembali/'.$dt->id)}}" class="btn btn-success btn-sm btn-flat">Kembalikan</a>
                                @if($dt->anggota->jenis_anggota=='siswa')
                                <button data-toggle="modal" data-target="#modalrusak-{{$dt->id}}" class="btn btn-danger btn-sm " class="fa fa-check">Rusak</button>
                                <!-- <a href="{{ url('/pinjam/hilang/'.$dt->id) }}" class="btn btn-warning btn-xs " class="fa fa-check">Hilang</a> -->
                                <button data-toggle="modal" data-target="#modalhilang-{{ $dt->id }}" class="btn btn-warning btn-sm " class="fa fa-check">Hilang</button>
                                @endif
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal Hilang-->
@foreach($data as $hilang)
<div class="modal fade" id="modalhilang-{{ $hilang->id }}" tabindex=" -1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Pinjaman</h5>
            </div>
            <div class="modal-body">
                <form action="{{ url('pengembalian/hilang/'.$hilang->id) }}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group {{$errors->has('denda') ? 'has-error' :''}}">
                        <label for="exampleFormControlInput1">Denda Sebelumnya</label>
                        <input name="denda" type="text" class="form-control" readonly id="inputdhs" placeholder="Denda Sebelumnya" value="{{$hilang->denda}}">
                        @if($errors->has('denda'))
                        <span class="right badge badge-danger" class=" help-block">{{$errors->first('denda')}}</span>
                        @endif
                    </div>
                    <div class="form-group {{$errors->has('denda') ? 'has-error' :''}}">
                        <label for="exampleFormControlInput1">Denda Hilang</label>
                        <input name="denda" type="text" class="form-control" id="inputdh" placeholder="Input Judul Buku" value="">
                        @if($errors->has('denda'))
                        <span class="right badge badge-danger" class=" help-block">{{$errors->first('denda')}}</span>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas  fa-power-off"></i> Tutup</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal Rusak-->
@foreach($data as $rusak)
<div class="modal fade" id="modalrusak-{{ $rusak->id }}" tabindex=" -1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rusak">Rusak</h5>
            </div>
            <div class="modal-body">
                <form action="{{ url('pengembalian/rusak/'.$rusak->id) }}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group {{$errors->has('denda') ? 'has-error' :''}}">
                        <label for="exampleFormControlInput1">Denda Sebelumnya</label>
                        <input name="denda" type="text" class="form-control" id="denda" readonly placeholder="Denda Sebelumnya" value="{{$rusak->denda}}">
                        @if($errors->has('denda'))
                        <span class="right badge badge-danger" class=" help-block">{{$errors->first('denda')}}</span>
                        @endif
                    </div>
                    <div class="form-group {{$errors->has('denda') ? 'has-error' :''}}">
                        <label for="exampleFormControlInput1">Denda Rusak</label>
                        <input name="denda" type="text" class="form-control" id="inputdr" placeholder="Denda Rusak" value="">
                        @if($errors->has('denda'))
                        <span class="right badge badge-danger" class=" help-block">{{$errors->first('denda')}}</span>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas  fa-power-off"></i> Tutup</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
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
            $('.sidebar').click(function(e){
              $('.preloader').fadeIn();
            })

            var flash = "{{ Session::has('sukses') }}";
            if (flash) {
                var pesan = "{{ Session::get('sukses') }}"
                swal("Sukses", pesan, "success");
            }

            var gagal = "{{ Session::has('gagal') }}";
            if (gagal) {
                var pesan = "{{ Session::get('gagal') }}"
                swal("Error", pesan, "error");
            }

            var peringatan = "{{ Session::has('peringatan') }}";
            if (peringatan) {
                var pesan = "{{ Session::get('peringatan') }}"
                swal("Warning", pesan, "warning");
            }
            var info = "{{ Session::has('info') }}";
            if (info) {
                var pesan = "{{ Session::get('info') }}"
                swal("Info", pesan, "info");
            }


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