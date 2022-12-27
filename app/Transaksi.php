<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksis';
    protected $fillable = [
        'id',
        'anggota_id',
        'buku_id',
        'kd_peminjam',
        'tgl_pinjam',
        'tgl_kembali',
        'status',
        'status_denda',
        'denda',
        'ket'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
