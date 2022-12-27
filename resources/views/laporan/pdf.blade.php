<!DOCTYPE html>
<html>

<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
    
    <style type="text/css">
        body {
            font-family: 'Times New Roman', Times, serif;
            color: #333;
            text-align: left;
            font-size: 16px;
            margin: 0;
        }
        
        .container {
            margin: 0 auto;
            margin-top: 35px;
            padding: 0px;
            width: 100%;
            height: auto;
            background-color: #fff;
        }
        
        .col-lg-3 {
            margin: 0px;
            width: 30%;
        }
        
        .col-lg-6 {
            margin: 0px;
            width: 60%;
        }
        
        
        caption {
            font-size: 28px;
            margin-bottom: 15px;
        }
        
        table {
            border: 0px solid #333;
            border-collapse: collapse;
            margin: 0 auto;
            width: auto;
            width: 100%;
        }
        
        th {
            border: 1px solid black;
        }
        
        td {
            border: 1px solid black;
            padding: 2px;
        }
        
        tr {
            border: 1px solid black;
        }
        
        img {
            width: 90px;
            height: 90px;
            border-radius: 100%;
        }
        
        .center {
            text-align: center;
        }
        
        .left {
            text-align: left;
        }
        
        .right {
            text-align: right;
        }
        
        .main-footer {
            width: 100%;
            height: 50px;
            padding: 2px;
            line-height: 50px;
            background: white;
            color: #333;
            position: absolute;
            bottom: 0px;
        }
        
        .main-header {
            width: 100%;
            height: 50px;
            padding: 2px;
            line-height: 50px;
            background: white;
            color: #333;
            position: absolute;
            bottom: 0px;
        }
        
        hr {
            border: 2px solid black double;
        }
        
    </style>
    <link rel="stylesheet" href="">
    <title>@yield('judul')</title>
</head>

<body>
    <table class="center">
        <tr>
            <td rowspan="3" class="center" style="border: 0px;">
                <img src="image/logo.png" class="center" class="img img-responsive">
            </td>
            <td style="border: 0px;">
                <b> PEMERINTAH KABUPATEN MAJALENGKA</b>
            </td>
            <td rowspan="3" class="center" style="border: 0px;">
                <img src="image/logotutwuri.png" class="center" class="img img-responsive">
            </td>
        </tr>
        <tr>
            <td style="border: 0px;">
                <b> DINAS PENDIDIKAN DAN KEBUDAYAAN</b>
            </td>
        </tr>
        <tr>
            <td style="border: 0px;">
                <b style="font-size: 30px;">MAN 3 Majalengka</b>
            </td>
        </tr>
        <tr>
            <td style="border: 0px;">NPSN :</td>
            <td style="border: 0px;">
                <font style="font-size: 20px;">Jl. Lanud S. Soekani No. 110, Kec. Jatiwangi, Kab. Majalengka, Jawa Barat.
                </font>
            </td>
            <td style="border: 0px;">NSS : </td>
        </tr>
    </table>
    <h1 class="center"></h1>
    <hr>
    @if (request('status') == 'kembali')
    <h5 class="center"><u> LAPORAN DATA TRANSAKSI KEMBALI</u></h5>
    @elseif(request('status') == 'pinjam')
    <h5 class="center"><u> LAPORAN DATA TRANSAKSI DIPINJAM</u></h5>
    @elseif(request('status') == 'rusak')
    <h5 class="center"><u> LAPORAN DATA TRANSAKSI RUSAK</u></h5>
    @elseif(request('status') == 'hilang')
    <h5 class="center"><u> LAPORAN DATA TRANSAKSI HILANG</u></h5>
    @elseif(request('status') == 'tolak')
    <h5 class="center"><u> LAPORAN DATA TRANSAKSI DITOLAK</u></h5>
    @else
    <h5 class="center"><u> LAPORAN DATA TRANSAKSI</u></h5>
    @endif
    
    <table id="pseudo-demo">
        <thead>
            <tr>
                <td>No</td>
                <td>Kode</td>
                <td>Judul</td>
                <td>Peminjam</td>
                <td>Tgl Pinjam</td>
                @if (request('status') == 'hilang')
                
                @else
                <td>Tgl Kembali</td>
                @endif
                
                <td>Status</td>
                <td>Denda</td>
            </tr>
        </thead>
        
        <tbody>
            @foreach ($data as $e => $dt)
            
            <tr>
                <td>{{$e+1}}</td>
                <td>{{$dt->kd_peminjam}}</td>
                <td>{{$dt->anggota->nama_anggota}}</td>
                <td>{{$dt->buku->nama_buku}}</td>
                <td>{{$dt->tgl_pinjam}}</td>
                <td>{{$dt->tgl_kembali}}</td>
                @if (request('status') == 'hilang')
                
                @else
                <td>{{ $dt->tgl_kembali }}</td>
                @endif
                
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
                
            </tr>
            @endforeach
        </tbody>
    </table>
    <p class="right">Majalengka, {{ $tgl }}</p>
    
    <br>
    <p class="right">Admin</p>
</body>

</html>
