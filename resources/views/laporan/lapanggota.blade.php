<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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
                <img src="public/image/logotutwuri.png" class="center" class="img img-responsive">
            </td>
        </tr>
        <tr>
            <td style="border: 0px;">
                <b> DINAS PENDIDIKAN DAN KEBUDAYAAN</b>
            </td>
        </tr>
        <tr>
            <td style="border: 0px;">
                <b style="font-size: 30px;">MAN 3 Majalengka </b>
            </td>
        </tr>
        <tr>
            <td style="border: 0px;">NPSN :10502828</td>
            <td style="border: 0px;">
                <font style="font-size: 20px;">Jl. Lanud S. Soekani No. 110, Kec. Jatiwangi, Kab. Majalengka, Jawa Barat.</font>
            </td>
            <td style="border: 0px;">NSS : </td>
        </tr>
    </table>
    <hr>
    <h5 class="center"><u> LAPORAN DATA ANGGOTA</u></h5>
    <table id="pseudo-demo">
        <thead>
            <tr>
                <td>No</td>
                <td>Kode Anggota</td>
                <td>Nama</td>
                <td>Jenis Kelamin</td>
                <td>TTL</td>
                <td>Jenis Anggota</td>
                <td>Alamat</td>
                
            </tr>
        </thead>
        
        <tbody>
            @foreach ($data as $e=>$dt)
            <tr>
                <td>{{$e+1}}</td>
                <td>{{$dt->kd_anggota}}</td>
                <td>{{$dt->nama_anggota}}</td>
                <td>{{$dt->jenis_anggota}}</td>
                <td>{{$dt->tempat_lahir}}</td>
                <td>{{$dt->tgl_lahir}}</td>
                <td>{{$dt->alamat}}</td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
    <p class="right">Majalengka, {{$tgl}}</p>
    
    <br>
    <p class="right">Admin</p>
</body>
</html>

