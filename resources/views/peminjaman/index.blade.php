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
                                @elseif($dt->status=='pinjam')
                                <span class="badge badge-primary">Dipinjam</span>
                                @elseif($dt->status=='kembali')
                                <span class="badge badge-success">Kembali</span>
                                @elseif($dt->status=='rusak')
                                <span class="badge badge-danger">Rusak</span>
                                @elseif($dt->status=='hilang')
                                <span class="badge badge-warning">Hilang</span>
                                @else
                                <span class="badge badge-warning">Ditolak</span>
                                @endif
                            </td>
                            <td>Rp. {{ number_format($dt->denda) }}</td>
                            <td>
                                @if ($dt->status == 'proses')
                                <a href="{{ url('peminjaman/setujui/' . $dt->id) }}"
                                    class="btn btn-primary btn-sm btn-flat">Setujui</a>
                                    <a href="{{ url('peminjaman/tolak/' . $dt->id) }}"
                                        class="btn btn-danger btn-sm btn-flat">Tolak</a>
                                        @elseif($dt->status=='pinjam')
                                        <a href="{{ url('peminjaman/perpanjang/' . $dt->id) }}"
                                            class="btn btn-success btn-sm btn-flat">Perpanjang</a>
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
            <div class="modal" id="exampleModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Peminjaman</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('peminjaman/create') }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group {{ $errors->has('kd_peminjam') ? 'has-error' : '' }}">
                                    <label for="kd_peminjam">Kode Transaksi</label>
                                    <input name="kd_peminjam" type="text" class="form-control" id="inputkode" required readonly
                                    placeholder="Input kode" value="{{ 'PMJ'. $kode }}">
                                    @if ($errors->has('kd_peminjam'))
                                    <span class="right badge badge-danger"
                                    class=" help-block">{{ $errors->first('kd_peminjam') }}</span>
                                    @endif
                                </div>
                                
                                <div class="form-group {{ $errors->has('anggota_id') ? 'has-error' : '' }}">
                                    <label for="anggota _id">Nama</label>
                                    <select name="anggota_id" class="form-control select2" id="exampleFormControlSelect1">
                                        
                                        @foreach ($anggota as $ang)
                                        <option value="{{ $ang->id }}">{{ $ang->nama_anggota }} ({{ $ang->jenis_anggota }})
                                        </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('anggota_id'))
                                    <span class="right badge badge-danger"
                                    class=" help-block">{{ $errors->first('anggota_id') }}</span>
                                    @endif
                                </div>
                                
                                
                                <div class="form-group {{ $errors->has('buku_id') ? 'has-error' : '' }}">
                                    <label for="exampleFormControlSelect1">Judul Buku</label>
                                    <select name="buku_id" class="form-control select2" data-width="100%">
                                        
                                        @foreach ($buku as $ang)
                                        <option value="{{ $ang->id }}">{{ $ang->nama_buku }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('buku_id'))
                                    <span class="right badge badge-danger"
                                    class=" help-block">{{ $errors->first('buku_id') }}</span>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                        class="fa  fa-power-off"></i> Tutup</button>
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