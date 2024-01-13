<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    //CRUD KATEGORI
    public function kategori()
    {
        $kategori = Kategori::all();
        return view('kategoris.kategori', ['kategori' => $kategori]);
    }

    public function  kategoriTambah()
    {
        return view('kategoris.kategori_tambah');
    }
    public function  kategoriAksi(Request $data)
    {
        $data->validate([
            'kategori' => 'required'
        ]);
        $kategori = $data->kategori;
        Kategori::insert([
            'kategori' => $kategori
        ]);
        return redirect('kategori')->with("sukses", "Kategori berhasil tersimpan");
    }

    public function kategoriEdit($id)
    {
        $kategori = Kategori::find($id);
        return view('kategoris.kategori_edit', ['kategori' => $kategori]);
    }

    public function kategoriUpdate($id, Request $data)
    {
        // form validasi

        $data->validate([
            'kategori' => 'required'
        ]);

        $nama_kategori = $data->kategori;


        // update kategori
        $kategori = Kategori::find($id);
        $kategori->kategori = $nama_kategori;
        $kategori->save();
        // alihkan halaman ke halaman kategori
        return redirect('kategori')->with("sukses", "Kategori berhasil diubah");
    }

    public function kategoriHapus($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();
        return redirect('kategori')->with("sukses", "Kategori berhasil dihapus");
    }

    // CRUD TRANSAKSI
    public function transaksi()
    {
        //mengambil data
        $transaksis = Transaksi::orderBy('id', 'desc')->paginate(6);

        // dd($transaksis);
        return view('transaksis.transaksi', ['transaksis' => $transaksis]);
    }

    public function transaksiTambah()
    {
        $kategori = Kategori::all();
        return view('transaksis.transaksi_tambah', ['kategori' => $kategori]);
    }

    public function transaksiSimpan(Request $data)
    {
        // validasi tanggal,jenis,kategori,nominal wajib isi
        $data->validate([
            'tanggal' => 'required',
            'jenis' => 'required',
            'kategori' => 'required',
            'nominal' => 'required'
        ]);
        // insert data ke table transaksi
        Transaksi::insert([
            'tanggal' => $data->tanggal,
            'jenis' => $data->jenis,
            'kategori_id' => $data->kategori,
            'nominal' => $data->nominal,
            'keterangan' => $data->keterangan
        ]);
        // alihkan halaman ke halaman transaksi sambil mengirim session pesan
        return redirect('transaksi')->with("sukses", "Transaksi berhasil tersimpan");
    }

    public function transaksiHapus($id)
    {
        $hapus = Transaksi::find($id);
        if ($hapus->delete()) {
            return redirect('transaksi')->with("sukses", "Transaksi berhasil dihapus");
        } else {
            return redirect('transaksi')->with("error", "Transaksi gagal dihapus");
        };
    }

    public function transaksiEdit($id)
    {
        $kategori = Kategori::all();
        $transaksi = Transaksi::find($id);
        return view('transaksis.transaksi_edit', [
            'transaksi' => $transaksi,
            'kategori' => $kategori
        ]);
    }

    public function transaksiUpdate($id, Request $data)
    {
        // validasi tanggal,jenis,kategori,nominal wajib isi
        $data->validate([
            'tanggal' => 'required',
            'jenis' => 'required',
            'kategori' => 'required',
            'nominal' => 'required'
        ]);

        // ambil transaksi berdasarkan id
        $transaksi = Transaksi::find($id);

        // update data ke table transaksi
        $transaksi->tanggal = $data->tanggal;
        $transaksi->jenis = $data->jenis;
        $transaksi->kategori_id = $data->kategori;
        $transaksi->nominal = $data->nominal;
        $transaksi->keterangan = $data->keterangan;

        //simpan perubahan
        $transaksi->save();

        return redirect('transaksi')->with("sukses", "Transaksi berhasil diubah");
    }

    public function transaksiCari(Request $data)
    {
        //keyword pencarian
        $cari = $data->cari;

        //mengambil data transaksi
        $transaksis = Transaksi::orderBY('id', 'desc')
            ->orWhere('jenis', 'like', "%" . $cari . "%")
            ->orWhere('tanggal', 'like', "%" . $cari . "%")
            ->orWhere('keterangan', 'like', "%" . $cari . "%")
            ->orWhere('nominal', '=', "%" . $cari . "%")
            ->paginate(6);

        //menambahkan keyword pencarian ke data transaksi
        $transaksis->appends($data->only('cari'));

        // passing data transaksi ke view transaksi.blade.php
        return view('transaksis.transaksi', ['transaksis' => $transaksis]);
    }
}
