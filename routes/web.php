<?php

use App\Http\Controllers\HomeController;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => true,
    'reset' => false
]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Kategori
Route::get('/kategori', [App\Http\Controllers\HomeController::class, 'kategori'])->name('kategori');
Route::get('/kategori/tambah', [App\Http\Controllers\HomeController::class, 'kategoriTambah'])->name('kategoriTambah');
Route::post('/kategori/aksi', [App\Http\Controllers\HomeController::class, 'kategoriAksi'])->name('kategoriAksi');
Route::get('/kategori/edit/{id}', [App\Http\Controllers\HomeController::class, 'kategoriEdit'])->name('kategoriEdit');
Route::put('/kategori/update/{id}', [App\Http\Controllers\HomeController::class, 'kategoriUpdate'])->name('kategoriUpdate');
Route::get('/kategori/hapus/{id}', [App\Http\Controllers\HomeController::class, 'kategoriHapus'])->name('kategoriHapus');

//Transaksi
Route::get('/transaksi', [App\Http\Controllers\HomeController::class, 'transaksi'])->name('transaksi');
Route::get('/transaksi/tambah', [App\Http\Controllers\HomeController::class, 'transaksiTambah'])->name('transaksiTambah');
Route::post('/transaksi/simpan', [App\Http\Controllers\HomeController::class, 'transaksiSimpan'])->name('transaksiSimpan');
Route::get('/transaksi/hapus/{id}', [App\Http\Controllers\HomeController::class, 'transaksiHapus'])->name('transaksiHapus');
Route::get('/transaksi/edit/{id}', [App\Http\Controllers\HomeController::class, 'transaksiEdit'])->name('transaksiEdit');
Route::put('/transaksi/update/{id}', [App\Http\Controllers\HomeController::class, 'transaksiUpdate'])->name('transaksiUpdate');
Route::get('/transaksi/cari', [App\Http\Controllers\HomeController::class, 'transaksiCari'])->name('transaksiCari');

//Laporan
Route::get('/laporan', [App\Http\Controllers\HomeController::class, 'laporan'])->name('laporan');
Route::get('/laporan/hasil', [App\Http\Controllers\HomeController::class, 'laporanHasil'])->name('laporanHasil');
Route::get('/laporan/excel', [App\Http\Controllers\HomeController::class, 'laporanExcel'])->name('laporanExcel');
