<?php

namespace Database\Seeders;

use App\Models\JenisPerniagaan;
use Illuminate\Database\Seeder;

class JenisPerniagaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisPerniagaan::create([
            'kod_jenis_perniagaan'=> 'A',
            'nama_jenis_perniagaan'=> 'PENGELUARAN PRODUK MAKANAN',
            'status'=> '1'
        ]);

        JenisPerniagaan::create([
            'kod_jenis_perniagaan'=> 'B',
            'nama_jenis_perniagaan'=> 'PENGELUARAN PRODUK BUKAN MAKANAN',
            'status'=> 'Tunggal'
        ]);

        JenisPerniagaan::create([
            'kod_jenis_perniagaan'=> 'C',
            'nama_jenis_perniagaan'=> 'PENGELUARAN PRODUK PERTANIAN',
            'status'=> 'Tunggal'
        ]);

        JenisPerniagaan::create([
            'kod_jenis_perniagaan'=> 'D',
            'nama_jenis_perniagaan'=> 'PERKHIDMATAN PEMASARAN',
            'status'=> 'Tunggal'
        ]);

        JenisPerniagaan::create([
            'kod_jenis_perniagaan'=> 'E',
            'nama_jenis_perniagaan'=> 'PERKHIDMATAN BUKAN PEMASARAN',
            'status'=> 'Tunggal'
        ]);

    }
}
