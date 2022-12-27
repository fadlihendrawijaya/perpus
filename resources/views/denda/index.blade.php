@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="card-header">Daftar Denda</div>
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
                            <td>{{$dt->kd_peminjam}}</td>
                            <td>{{$dt->buku->nama_buku}}</td>
                            <td>{{$dt->anggota->nama_anggota}}</td>
                            <td>{{$dt->tgl_pinjam}}</td>
                            <td>{{$dt->tgl_kembali}}</td>
                            <td>Rp. {{number_format($dt->denda)}}</td>
                            <td>
                                @if($dt->status_denda=='belum lunas')
                                <span class="badge badge-warning">Belum Lunas</span>
                                @elseif($dt->status_denda=='lunas')
                                <span class="badge badge-success">Lunas</span>
                                @endif
                            </td>
                            <td>
                                @if($dt->status_denda=='belum lunas')
                                <a href="{{url('denda/lunasi/'.$dt->id)}}" class="btn btn-primary btn-sm btn-flat">Lunasi</a>
                                @elseif($dt->status_denda=='lunas')
                                <a href="{{url('denda/kwitansi/'.$dt->id)}}" class="btn btn-warning btn-sm btn-flat">Kwitansi</a>
                                
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