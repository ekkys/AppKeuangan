<?php

namespace App\Exports;

use App\Models\Kategori;
use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Transaksi::all();

        //data kategori
        $kategori = Kategori::all();

        ///data filter
        $dari = $_GET['dari'];
        $sampai = $_GET['sampai'];
        $id_kategori = $_GET['kategori'];

        //periksa kategori
        if ($id_kategori == "semua") {
            // jika semua, tampilkan semua transaksi
            $laporan = Transaksi::whereDate('tanggal', '>=', $dari)
                ->whereDate('tanggal', '<=', $sampai)
                ->orderBy('id', 'desc')->get();
        } else {
            // jika yang dipilih bukan semua, tampilkan
            //transaksi berdasarkan kategori yang dipilih
            $laporan = Transaksi::where('kategori_id', $id_kategori)
                ->whereDate('tanggal', '>=', $dari)
                ->whereDate('tanggal', '<=', $sampai)
                ->orderBy('id', 'desc')->get();
        }


        // passing data laporan ke view laporan
        return view('laporan_excel', ['laporan' => $laporan, 'kategori' => $kategori]);
    }
}
