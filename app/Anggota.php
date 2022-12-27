<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggotas';
    protected $fillable = [
        'kd_anggota',
        'email',
        'password',
        'nama_anggota',
        'jenis_anggota',
        'jk_anggota',
        'tempat_lahir',
        'tgl_lahir',
        'alamat',
        'created_at', 
        'updated_at'
    ];
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
