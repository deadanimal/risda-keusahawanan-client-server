<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriUsahawan;
class KategoriUsahawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KategoriUsahawan::create([
            'id_kategori_usahawan'=> 'KU01',
            'nama_kategori_usahawan'=> 'PICO',
            'jualan_usahawan_min'=> '0',
            'jualan_usahawan_max'=> '60000',
            'status_kategori_usahawan'=> 'aktif'
        ]);

        KategoriUsahawan::create([
            'id_kategori_usahawan'=> 'KU02',
            'nama_kategori_usahawan'=> 'NANO',
            'jualan_usahawan_min'=> '60000',
            'jualan_usahawan_max'=> '149999',
            'status_kategori_usahawan'=> 'aktif'
        ]);

        KategoriUsahawan::create([
            'id_kategori_usahawan'=> 'KU03',
            'nama_kategori_usahawan'=> 'MIKRO',
            'jualan_usahawan_min'=> '150000',
            'jualan_usahawan_max'=> '299999',
            'status_kategori_usahawan'=> 'aktif'
        ]);

        KategoriUsahawan::create([
            'id_kategori_usahawan'=> 'KU04',
            'nama_kategori_usahawan'=> 'KECIL',
            'jualan_usahawan_min'=> '300000',
            'jualan_usahawan_max'=> '14999999',
            'status_kategori_usahawan'=> 'aktif'
        ]);

        KategoriUsahawan::create([
            'id_kategori_usahawan'=> 'KU05',
            'nama_kategori_usahawan'=> 'SEDERHANA',
            'jualan_usahawan_min'=> '15000000',
            'jualan_usahawan_max'=> '100000000',
            'status_kategori_usahawan'=> 'aktif'
        ]);

    }
}
