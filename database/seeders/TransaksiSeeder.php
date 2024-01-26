<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        // pengaturan bahasa faker
        $faker = Faker::create('id_ID');

        // input data dummy sebanyak perulangan
        for ($x = 1; $x <= 20; $x++) {
            //data dummy
            $tgl_hari_ini = date('Y-m-d');
            $jenis = $faker->randomElement(["Pemasukan", "Pengeluaran"]);
            $kategori = $faker->randomElement(["10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23"]);
            $nominal = $faker->randomElement(["100000", "200000", "300000", "50000", "1000000", "1500000"]);
            $keterangan = "";

            // insert ke database
            DB::table('transaksi')->insert([
                'tanggal' => $tgl_hari_ini,
                'jenis' => $jenis,
                'kategori_id' => $kategori,
                'nominal' => $nominal,
                'keterangan' => $keterangan
            ]);
        }
    }
}
