<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Denda extends Model
{
    protected $table = 'dendas';
    protected $fillable = [
        'id',
        'kd_peminjam',
        'anggota_id',
        'buku_id',
        'status',
        'denda'
    ];
    public function anggota(){
        return $this->belongsTo('App\Anggota', 'id');
    }
    public function buku(){
        return $this->belongsTo('App\Buku', 'id');
    }
    public function peminjam(){
        return $this->belongsTo('App\Peminjam', 'id');
    }
}
