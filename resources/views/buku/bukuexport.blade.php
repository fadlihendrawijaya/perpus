<table>
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
            <th>Deskripsi</th>
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
        </tr>
        @endforeach
    </tbody>
</table>