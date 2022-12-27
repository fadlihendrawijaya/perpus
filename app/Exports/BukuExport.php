<?php

namespace App\Exports;

use App\Buku;
use Maatwebsite\Excel\Concerns\FromCollection;

class BukuExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return view('buku.bukuexport', [
            'data' => Buku::all()
        ]);
    }
}
