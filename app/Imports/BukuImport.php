<?php

namespace App\Imports;

use App\Buku;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class BukuImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $head = [
            'No',
            'Kode',
            'Judul',
            'Penulis',
            'Penerbit',
            'Tahun Terbit',
            'Jumlah Buku',
            'Deskripsi',
        ];
        if ($head != $collection[0]->toArray()) {
            return back()->with('gagal', 'Format Data Tidak sesuai');
        }
        unset($collection[0]);
        set_time_limit(0);

        foreach ($collection as $key => $row) {
            $baris = $key + 1;
            Validator::make($row->toArray(), [
                ['nullable'],
                ['required'],
                ['required'],
                ['required'],
                ['required'],
                ['required'],
                ['required'],
                ['required'],
            ], [
                '1.required' => 'Kode (kolom B baris ke-' . $baris . ')wajib diisi.',
                '2.required' => 'Judul (kolom C baris ke-' . $baris . ')wajib diisi.',
                '3.required' => 'Penulis (kolom D baris ke-' . $baris . ')wajib diisi.',
                '4.required' => 'Penerbit (kolom E baris ke-' . $baris . ')wajib diisi.',
                '5.required' => 'Tahun Terbit (kolom F baris ke-' . $baris . ')wajib diisi.',
                '6.required' => 'Jumlah Buku (kolom G baris ke-' . $baris . ')wajib diisi.',
                '7.required' => 'Deskripsi (kolom H baris ke-' . $baris . ')wajib diisi.',
            ])->validate();

            $kode = $row[1];

            $data = [
                'kd_buku' => $kode,
                'nama_buku' => $row[2],
                'penulis' => $row[3],
                'penerbit' => $row[4],
                'tahun_terbit' => $row[5],
                'jumlah_buku' => $row[6],
                'deskripsi' => $row[7],
            ];
            $buku = Buku::where('kd_buku', $kode)->first();

            if ($buku) {
                $buku->update($data);
            } else {
                Buku::create($data);
            }
        }
        return back()->with('sukses', 'Data buku berhasil diimport');
    }
}
