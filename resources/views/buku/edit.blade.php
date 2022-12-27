@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card-body">
                <!-- Konten -->
                <form action="{{ url('buku/update/'. $data->id) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group {{ $errors->has('nama_buku') ? 'has-error' : '' }}">
                        <label for="nama_buku">Judul</label>
                        <input name="nama_buku" type="text" class="form-control" id="nama_buku" placeholder="Input judul"
                        value="{{ $data->nama_buku }}">
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
                                readonly value="{{ $data->kd_buku }}">
                                @if ($errors->has('kd_buku'))
                                <span class="right badge badge-danger"
                                class=" help-block">{{ $errors->first('kd_buku') }}</span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('penulis') ? 'has-error' : '' }}">
                                <label for="penulis">Pengarang</label>
                                <input name="penulis" type="text" class="form-control" id="penulis"
                                placeholder="Input pengarang" value="{{ $data->penulis }}">
                                @if ($errors->has('penulis'))
                                <span class="right badge badge-danger"
                                class=" help-block">{{ $errors->first('penulis') }}</span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('penerbit') ? 'has-error' : '' }}">
                                <label for="penerbit">Penerbit</label>
                                <input name="penerbit" type="text" class="form-control" id="penerbit"
                                placeholder="Input Penerbit" value="{{ $data->penerbit }}">
                                @if ($errors->has('penerbit'))
                                <span class="right badge badge-danger"
                                class=" help-block">{{ $errors->first('penerbit') }}</span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('tahun_terbit') ? 'has-error' : '' }}">
                                <label for="tahun_terbit">Tahun Terbit</label>
                                <input name="tahun_terbit" type="text" class="form-control" id="tahun_terbit"
                                placeholder="Input Tahun Terbit" value="{{ $data->tahun_terbit }}">
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
                                placeholder="Input Jumlah Buku" value="{{ $data->jml_buku }}">
                                @if ($errors->has('jml_buku'))
                                <span class="right badge badge-danger"
                                class=" help-block">{{ $errors->first('jml_buku') }}</span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('deskripsi') ? 'has-error' : '' }}">
                                <label for="exampleFormControlInput1">Deskripsi</label>
                                <input name="deskripsi" type="text" class="form-control" id="inputdeskripsi"
                                placeholder="Input deskripsi" value="{{ $data->deskripsi }}">
                                @if ($errors->has('deskripsi'))
                                <span class="right badge badge-danger"
                                class=" help-block">{{ $errors->first('deskripsi') }}</span>
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