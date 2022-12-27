<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'bukus';
    protected $fillable = [
        'id', 
        'kd_buku', 
        'nama_buku', 
        'isbn', 
        'penulis', 
        'penerbit', 
        'tahun_terbit', 
        'jml_buku', 
        'jml_dipinjam', 
        'deskripsi'
    ];
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
    public function penerbit(){
        return $this->belongsTo('App\Penerbit', 'id');
    }
    public function klasifikasi(){
        return $this->belongsTo('App\Klasifikasi', 'id');
    }
}
