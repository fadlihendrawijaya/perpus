<?php

namespace App\Http\Controllers;

use App\Anggota;
use App\Buku;
use App\Http\Controllers\Controller;
use App\Transaksi;
use App\User;
use PDF;
use Illuminate\Http\Request;

class LaporanController extends Controller
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
        $data = Transaksi::paginate(10);
        $title = 'Laporan';
        return view('laporan.index', compact('title', 'data', 'anggota', 'buku'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function peminjamanpdf(Request $request)
    {
        $tgl = date('d F Y');
        $dt = Transaksi::query();

        if ($request->get('status')) {
            if ($request->get('status') == 'pinjam') {
                $dt->where('status', 'pinjam');
            } elseif ($request->get('status') == 'kembali') {
                $dt->where('status', 'kembali');
            } elseif ($request->get('status') == 'rusak') {
                $dt->where('status', 'rusak');
            } elseif ($request->get('status') == 'hilang') {
                $dt->where('status', 'hilang');
            } elseif ($request->get('status') == 'tolak') {
                $dt->where('status', 'tolak');
            }
        }
        $data = $dt->get();

        $pdf = PDF::loadView('laporan.pdf', compact('data', 'tgl'))->setPaper('a4', 'Landscape');
        //S return $pdf->download('laporan_transaksi_harian' . date('Y-m-d_H-i-s') . '.pdf');
        return $pdf->stream();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pdf()
    {
        $tgl = date('d F Y');
        $data = Transaksi::get();
        $pdf = PDF::loadview('laporan.pdf', compact('data', 'tgl'))->setPaper('a4', 'landscape');
        return $pdf->stream('laporan' . date('Y-m-d_H:i:s') . '.pdf');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function anggotapdf()
    {
        $tgl = date('d F Y');
        $data = Anggota::get();
        $pdf = PDF::loadview('laporan.lapanggota', compact('data', 'tgl'))->setPaper('a4', 'landscape');
        return $pdf->stream('anggota' . date('Y-m-d_H:i:s') . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bukupdf()
    {
        $tgl = date('d F Y');
        $data = Buku::get();
        $pdf = PDF::loadview('laporan.lapbuku', compact('data', 'tgl'))->setPaper('a4', 'landscape');
        return $pdf->stream('buku' . date('Y-m-d_H:i:s') . '.pdf');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function periodepdf(Request $request)
    {
        $tgl = date('d F Y');
        $dari = $request->dari;
        $sampai = $request->sampai;
        // $total = Peminjaman::where('created_at', today())->sum('denda', $denda);

        $data = Transaksi::whereDate('created_at', '>=', $dari)->whereDate('created_at', '<=', $sampai)->orderBy('created_at', 'ASC')->get();
        $pdf = PDF::loadView('laporan.periode', compact('data', 'dari', 'sampai', 'tgl'))->setPaper('a4', 'Landscape');
        //S return $pdf->download('laporan_transaksi_harian' . date('Y-m-d_H-i-s') . '.pdf');
        return $pdf->stream();
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
