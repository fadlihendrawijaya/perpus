@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="text-right py-4">
                <div class="btn-group dropdown float-right">
                    <button type="button" class="btn btn-sm btn-flat btn-primary  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <b><i class="fa fa-printh"></i> Cetak Laporan</b>
                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                            <a href="{{url('laporan/pdf')}}" class="dropdown-item">Semua</a>
        
                            <a href="{{url('laporan/peminjamanpdf?status=pinjam')}}" class="dropdown-item"> Dipinjam/Blm Kembali</a>
        
                            <a href="{{url('laporan/peminjamanpdf?status=kembali')}}" class="dropdown-item"> Sudah Kembali</a>
        
                            <a href="{{url('laporan/peminjamanpdf?status=tolak')}}" class="dropdown-item"> Ditolak</a>
        
                            <a href="{{url('laporan/peminjamanpdf?status=hilang')}}" class="dropdown-item"> Hilang</a>
        
                            <a href="{{url('laporan/peminjamanpdf?status=rusak')}}" class="dropdown-item"> Rusak</a>
                            <button class="dropdown-item btn-priodepdf" data-toggle="modal" data-target="#modal"> Periode</button>
        
        
                            <a href="{{url('laporan/anggotapdf')}}" class="dropdown-item"> Laporan Anggota</a>
                            <a href="{{url('laporan/bukupdf')}}" class="dropdown-item"> Laporan Buku</a>
                        </div>
                    </button>

                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                        <a href="{{url('laporan/pdf')}}" class="dropdown-item">Semua</a>
    
                        <a href="{{url('laporan/peminjamanpdf?status=pinjam')}}" class="dropdown-item"> Dipinjam/Blm Kembali</a>
    
                        <a href="{{url('laporan/peminjamanpdf?status=kembali')}}" class="dropdown-item"> Sudah Kembali</a>
    
                        <a href="{{url('laporan/peminjamanpdf?status=tolak')}}" class="dropdown-item"> Ditolak</a>
    
                        <a href="{{url('laporan/peminjamanpdf?status=hilang')}}" class="dropdown-item"> Hilang</a>
    
                        <a href="{{url('laporan/peminjamanpdf?status=rusak')}}" class="dropdown-item"> Rusak</a>
                        <button class="dropdown-item btn-priodepdf" data-toggle="modal" data-target="#modal"> Periode</button>
    
    
                        <a href="{{url('laporan/anggotapdf')}}" class="dropdown-item"> Laporan Anggota</a>
                        <a href="{{url('laporan/bukupdf')}}" class="dropdown-item"> Laporan Buku</a>
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
                            <th>Kode Peminjam</th>
                            <th>Nama Anggota</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Denda</th>
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
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-default modal-dialog-centered modal-" role="document">
        <div class="modal-content">

            <div class="modal-header">
                Pilih Panggal
            </div>
            <div class="modal-body">

                <form role="form" action="{{ url('laporan/periodepdf') }}" method="get">
                    <div class="box-body">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Dari Tanggal</label>
                            <input type="date" class="form-control datepicker" id="inputtgl" placeholder="Dari Tanggal" name="dari" autocomplete="off" value="{{ date('Y-m-d') }}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Sampai tanggal</label>
                            <input type="date" class="form-control datepicker" name="sampai" id="inputtgl2" placeholder="Sampai Tanggal" autocomplete="off" value="{{ date('Y-m-d') }}">
                        </div>

                    </div>
                    <!-- /.box-body -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa  fa-power-off"></i> Tutup</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</button>
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