<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = "transaksi";

    protected $fillable = ['tanggal', 'jenis', 'kategori_id', 'nominal', 'keterangan'];

    public function kategori()
    {
        return $this->belongsTo('App\Kategori');
    }
}