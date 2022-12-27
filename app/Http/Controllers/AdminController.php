<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $data = User::all();
        $title = 'Data Admin';
        return view('admin.index', compact('title', 'data'));
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
            
            
        ];
        //dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ], $messages);
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return redirect()->back()->with('sukses', 'Data  Berhasil di Tambah');
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
        $title = 'Edit Admin';
        
        $data = User::find($id);
        return view('admin.edit', compact('data', 'title'));
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
            'max' => ':attribute harus diisi maksimal :max karakter!'
        ];
        //dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ], $messages);
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = bcrypt($request->password);
        $data['updated_at'] = date('Y-m-d H:i:s', strtotime(Carbon::today()->toDateString()));
        
        User::where('id', $id)->update($data);
        return redirect('admin')->with('sukses', 'Data Berhasil Diedit');
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
            $data = User::find($id);
            $data->delete();
            return \redirect()->back()->with('sukses', 'Data Anggota Berhasil Dihapus');
        } catch (\throwable $th) {
            return \redirect()->back()->with('Gagal', 'Gagal Data Berelasi DiTabel Lain');
        }
    }
}
