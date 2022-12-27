<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anggota;
use App\Buku;
use App\Denda;
use App\Http\Controllers\Controller;
use App\Transaksi;
use App\User;
use PDF;
use Illuminate\Support\Facades\Auth;

class DendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Denda';

        $anggota = Anggota::get();
        $buku = Buku::where('jml_buku', '>', 0)->get();

        $data = Transaksi::whereIn('status_denda', ['belum lunas', 'lunas'])->get();
        $title = 'Denda';
        return view('denda.index', compact('title', 'data', 'anggota', 'buku'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bayar($id)
    {
        $data = Transaksi::findOrFail($id);
        Transaksi::where('id', $id)->update(['status_denda' => 'lunas']);
        // Denda::where('id', $id)->update(['status_denda' => 'lunas']);
        return redirect()->back()->with('sukses', 'Denda Berhasi dilunasi');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function kwitansi($id)
    {
        $tgl = date('d F Y');
        // $tgl = date('F - d - y');
        $data = Transaksi::find($id);
        $pdf = PDF::loadview('denda.kwitansi', compact('data', 'tgl'))->setPaper('a5', 'landscape');
        return $pdf->stream('kwitansi' . date('Y-m-d_H:i:s') . '.pdf');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
