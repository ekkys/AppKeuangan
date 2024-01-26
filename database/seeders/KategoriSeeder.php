<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // pengaturan bahasa faker
        // $faker = Faker::create('id_ID');

        // for ($i = 1; $i <= 4; $i++) {
        //     $kategori = $faker->randomElement(["Gaji", "Laba", "Beli Bahan"]);

        //     // insert ke database
        //     DB::table('kategori')->insert([
        //         'kategori' => $kategori
        //     ]);
        // }
    }
}