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
    <h1 class="center">MAN 3 MAJALENGKA</h1>
    <hr>
    <h5 class="center"><u> Kwitansi Denda</u></h5>
    <table id="pseudo-demo">
        <thead>
            <tr>
                <td>Kode Pinjam</td>
                <td>Nama</td>
                <td>Buku</td>
                <td>Tanggal Pinjam</td>
                <td>Tanggal Kembali</td>
                <td>Status Peminjaman</td>
                <td>Denda</td>
                <td>Keterangan
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $data->kd_peminjam }}</td>
                <td>{{ $data->anggota->nama_anggota }}</td>
                <td>{{ $data->buku->nama_buku }}</td>
                <td> {{date('d/m/y', strtotime($data->tgl_pinjam))}}</td>
                <td> {{date('d/m/y', strtotime($data->tgl_kembali))}}</td>
                <td>{{ $data->status }}</td>
                <td><span class="badge badge-danger">Rp. {{ number_format($data->denda ,0)}}</span></td>
                @if( $data->status_denda==1)
                <td> <span class="label label-danger">Belum Lunas</span></td>
                @else($data->status_denda==2)
                <td> <span class="label label-primary">Lunas</span></td>
                @endif
            </tr>
        </tbody>
    </table>
    <p class="right">Majalengka, {{$tgl}}</p>

    <br>
    <p class="right">Petugas Perpustakaan</p>
</body>

</html>