<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anggota;
use App\Buku;
use App\Http\Controllers\Controller;
use App\Transaksi;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class TransaksiController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        
        // $getRow = Transaksi::orderBy('id', 'DESC')->get();
        // $rowCount = $getRow->count();

        // $lastId = $getRow->first();

        // $kode = date('d-m-Y')."00001";

        // if ($rowCount > 0) {
        //     if ($lastId->id < 9) {
        //         $kode = "0000" . '' . ($lastId->id + 1);
        //     } else if ($lastId->id < 99) {
        //         $kode = "000" . '' . ($lastId->id + 1);
        //     } else if ($lastId->id < 999) {
        //         $kode = "00" . '' . ($lastId->id + 1);
        //     } else if ($lastId->id < 9999) {
        //         $kode = "0" . '' . ($lastId->id + 1);
        //     } else {
        //         $kode = "" . '' . ($lastId->id + 1);
        //     }
        // }
        $kode = Str::random(8);
        $anggota = Anggota::get();
        $buku = Buku::where('jml_buku', '>', 0)->get();

        $data = Transaksi::orderBy('id', 'DESC')->get();
        $title = 'Peminjaman';
        return view('peminjaman.index', compact('title', 'data', 'anggota', 'buku', 'kode'));
    }
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create(Request $request)
    {
        $cek = Transaksi::whereIn('status', ['pinjam', 'proses'])->where('anggota_id', $request->get('anggota_id'))->count();
        if ($cek < 3) {
            if (Transaksi::where('anggota_id', $request->get('anggota_id'))->where('buku_id', $request->get('buku_id'))->whereIn('status', ['pinjam', 'proses'])->exists()) {
                return redirect()->back()->with('info', 'Buku Telah dipinjam');
            } else {
                $messages = [
                    'required' => ':attribute wajib diisi!',
                    'min' => ':attribute harus diisi minimal :min karakter!',
                    'max' => ':attribute harus diisi maksimal :max karakter!',
                    'kd_buku.required' => 'isbn Wajib di Isi',
                    'nama_buku.required' => 'Judul Wajib di Isi',
                ];
                //dd($request->all());
                $this->validate($request, [
                    'buku_id' => 'required',
                    'anggota_id' => 'required',
                ], $messages);

                // DD($request->all());
                $transaksi = Transaksi::create([
                    'kd_peminjam' => $request->get('kd_peminjam'),
                    'tgl_pinjam' => Date('Y-m-d', strtotime(Carbon::today()->toDateString())),
                    'tgl_kembali' => Date('Y-m-d', strtotime(Carbon::today()->addDay(7)->toDateString())),
                    'buku_id' => $request->get('buku_id'),
                    'anggota_id' => $request->get('anggota_id'),
                    'denda' => 0,
                    'status' => 'pinjam'
                ]);


                $transaksi->buku->where('id', $transaksi->buku_id)
                    ->update([
                        'jml_buku' => ($transaksi->buku->jml_buku - 1),
                        'jml_dipinjam' => $transaksi->buku->jml_dipinjam + 1,
                    ]);

                // Transaksi::insert($data);
                return redirect()->back()->with('sukses', 'Transaksi Berhasil ditambah');
            }
        } else {
            return  redirect()->back()->with('info', 'Peminjaman Maksimal');
        }
    }
    
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function setujui($id)
    {
        $data = Transaksi::find($id);
        $buku_id = $data->buku_id;
        $bk = Buku::find($buku_id);
        $b = $bk->jml_buku;
        $c = $b - 1;


        $dipinjam = $bk->jml_dipinjam;
        $d = $dipinjam + 1;

        $cek = Buku::where('id', $buku_id)->where('jml_buku', '>', 0)->count();
        if ($cek) {
            Transaksi::where('id', $id)->update(['status' => 'pinjam']);
            Buku::where('id', $buku_id)
                ->update([
                    'jml_buku' => $c,
                    'jml_dipinjam' => $d,
                ]);

            return redirect()->back()->with('sukses', 'Transaksi Berhasil disetujui');
        } else {
            Transaksi::where('id', $id)->update(['status' => 'tolak']);
            return redirect()->back()->with('gagal', 'Buku Kosong Transaksi Ditolak');
        }
    }
    
    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function tolak($id)
    {
        $data = Transaksi::find($id);
        Transaksi::where('id', $id)->update(['status' => 'tolak']);

        return redirect()->back()->with('sukses', 'Transaksi Ditolak');
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function perpanjang($id)
    {
        $data = Transaksi::find($id);
        Transaksi::where('id', $id)->update(['tgl_kembali' => Date('Y-m-d', strtotime(Carbon::today()->addDay(7)->toDateString())),]);
        return redirect()->back()->with('sukses', 'Berhasil Di perpanjang');
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        //
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        //
    }
}
