<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buku;
use App\Exports\BukuExport;
use App\Http\Controllers\Controller;
use App\Imports\BukuImport;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kode = Str::random(12);
        $data = Buku::all();
        $title = 'Data Buku';
        return view('buku.index', compact('title', 'data', 'kode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi!',
            'min' => ':attribute harus diisi minimal :min karakter!',
            'max' => ':attribute harus diisi maksimal :max karakter!',
            'nama_buku.required' => 'Judul Wajib di Isi',
            'penulis.required' => 'pengarang Wajib di Isi',
            'penerbit.required' => 'penerbit Wajib di Isi',
            'tahun_terbit.required' => 'tahun terbit Wajib di Isi',
            'jml_buku.required' => 'jumlah buku Wajib di Isi',
            'deskripsi.required' => 'deskripsi Wajib di Isi',
            'required' => ':attribute wajib diisi!',
            'min' => ':attribute harus diisi minimal :min karakter!',
            'max' => ':attribute harus diisi maksimal :max karakter!',
        ];
        // dd($request->all());
        $this->validate($request, [
            'nama_buku' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'jml_buku' => 'required',
            'deskripsi' => 'required',
            'kd_buku' => 'required',


        ], $messages);
        $data['kd_buku'] = $request->kd_buku;
        $data['nama_buku'] = $request->nama_buku;
        $data['penulis'] = $request->penulis;
        $data['penerbit'] = $request->penerbit;
        $data['tahun_terbit'] = $request->tahun_terbit;
        $data['jml_buku'] = $request->jml_buku;
        $data['deskripsi'] = $request->deskripsi;
        $data['created_at'] = date('Y-m-d H:i:s', strtotime(Carbon::today()->toDateString()));
        $data['updated_at'] = date('Y-m-d H:i:s', strtotime(Carbon::today()->toDateString()));

        // dd($data);
        Buku::create($data);

        return redirect()->back()->with('sukses', 'Data Buku Berhasil di Tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $title = 'Edit Buku';

        $data = Buku::find($id);
        return view('buku.edit', compact('data', 'title'));
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
        $messages = [
            'required' => ':attribute wajib diisi!',
            'min' => ':attribute harus diisi minimal :min karakter!',
            'max' => ':attribute harus diisi maksimal :max karakter!',
            'nama_buku.required' => 'Judul Wajib di Isi',
            'penulis.required' => 'pengarang Wajib di Isi',
            'penerbit.required' => 'penerbit Wajib di Isi',
            'tahun_terbit.required' => 'tahun terbit Wajib di Isi',
            'jml_buku.required' => 'jumlah buku Wajib di Isi',
            'deskripsi.required' => 'deskripsi Wajib di Isi',
            'required' => ':attribute wajib diisi!',
            'min' => ':attribute harus diisi minimal :min karakter!',
            'max' => ':attribute harus diisi maksimal :max karakter!',
        ];
        //dd($request->all());
        $this->validate($request, [
            'nama_buku' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'jml_buku' => 'required',
            'deskripsi' => 'required',
            'kd_buku' => 'required',


        ], $messages);
        $data['kd_buku'] = $request->kd_buku;
        $data['nama_buku'] = $request->nama_buku;
        $data['penulis'] = $request->penulis;
        $data['penerbit'] = $request->penerbit;
        $data['tahun_terbit'] = $request->tahun_terbit;
        $data['jml_buku'] = $request->jml_buku;
        $data['deskripsi'] = $request->deskripsi;
        $data['updated_at'] = date('Y-m-d H:i:s', strtotime(Carbon::today()->toDateString()));

        Buku::where('id', $id)->update($data);
        return redirect('buku')->with('sukses', 'Buku Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = Buku::find($id);
            $data->delete();
            return \redirect()->back()->with('sukses', 'Data Buku Berhasil Dihapus');
        } catch (\throwable $th) {
            return \redirect()->back()->with('Gagal', 'Gagal Data Berelasi DiTabel Lain');
        }
    }
    public function export()
    {
        return Excel::download(new BukuExport, 'buku_' . date('Y-m-d_H-i-s') . '.xlsx');
    }
    public function import(Request $request)
    {
        $request->validate([
            'file_name' => ['required', 'file', 'max:2048']
        ]);
        Excel::import(new BukuImport, $request->file('file_name'));
        return back();
    }
}
