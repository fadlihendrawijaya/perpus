<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Anggota;
use App\User;
use PDF;
use Carbon\Carbon;
use Symfony\Contracts\Service\Attribute\Required;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getRow = Anggota::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();

        $lastId = $getRow->first();

        $kode = "AGT00001";

        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                $kode = "AGT0000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 99) {
                $kode = "AGT000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 999) {
                $kode = "AGT00" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                $kode = "AGT0" . '' . ($lastId->id + 1);
            } else {
                $kode = "AGT" . '' . ($lastId->id + 1);
            }
        }

        $data = Anggota::all();
        $title = 'Data Anggota';
        return view('anggota.index', compact('title', 'data', 'kode'));
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
            'email.unique' => 'Email Suda Terdaftar',
        ];
        //dd($request->all());
        $this->validate($request, [
            // 'kode_anggota' => 'required',
            'nama_anggota' => 'required',
            'email' => 'required|unique:anggotas',
            'password' => 'required',
            'jenis_anggota' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jk_anggota' => 'required',
            'alamat' => 'required',
        ], $messages);

        $data['kd_anggota'] = $request->kd_anggota;

        $data['nama_anggota'] = $request->nama_anggota;
        $data['email'] = $request->email;
        $data['password'] = bcrypt($request->password);
        $data['jenis_anggota'] = $request->jenis_anggota;
        $data['tempat_lahir'] = $request->tempat_lahir;
        $data['tgl_lahir'] = $request->tgl_lahir;
        $data['jk_anggota'] = $request->jk_anggota;
        $data['alamat'] = $request->alamat;
        $data['created_at'] = date('Y-m-d H:i:s', strtotime(Carbon::today()->toDateString()));
        $data['updated_at'] = date('Y-m-d H:i:s', strtotime(Carbon::today()->toDateString()));

        Anggota::create($data);

        return redirect()->back()->with('sukses', 'Data Siswa Berhasil di Tambah');
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
        $title = 'Edit Anggota';

        $data = Anggota::find($id);
        return view('anggota.edit', compact('data', 'title'));
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
            'email.unique' => 'Email Suda Terdaftar',
        ];
        //dd($request->all());
        $this->validate($request, [
            // 'kode_anggota' => 'required',
            'nama_anggota' => 'required',
            'email' => 'required|unique:anggotas',
            // 'password' => 'required',
            // 'jenis_anggota' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jk_anggota' => 'required',
            'alamat' => 'required',
        ], $messages);

        $data['nama_anggota'] = $request->nama_anggota;
        $data['email'] = $request->email;
        // $data['jenis_anggota'] = $request->jenis_anggota;
        $data['tempat_lahir'] = $request->tempat_lahir;
        $data['tgl_lahir'] = $request->tgl_lahir;
        $data['jk_anggota'] = $request->jk_anggota;
        $data['alamat'] = $request->alamat;
        $data['updated_at'] = date('Y-m-d H:i:s', strtotime(Carbon::today()->toDateString()));

        Anggota::where('id', $id)->update($data);
        return redirect('anggota')->with('sukses', 'Anggota Berhasil Diedit');
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
            $data = Anggota::find($id);
            $data->delete();
            return \redirect()->back()->with('sukses', 'Data Anggota Berhasil Dihapus');
        } catch (\throwable $th) {
            return \redirect()->back()->with('Gagal', 'Gagal Data Berelasi DiTabel Lain');
        }
    }
}
