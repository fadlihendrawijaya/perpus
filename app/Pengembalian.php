<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $table = 'pengembalians';
    protected $guarded = [];
    public function anggota(){
        return $this->belongsTo('App\Anggota', 'id');
    }
    public function buku(){
        return $this->belongsTo('App\Buku', 'id');
    }
}
