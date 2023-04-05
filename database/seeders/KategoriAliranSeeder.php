<?php

namespace Database\Seeders;

use App\Models\KategoriAliran;
use Illuminate\Database\Seeder;

class KategoriAliranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KategoriAliran::create([
            'jenis_aliran' => 'tunai_masuk',
            'bahagian' => '1',
            'nama_kategori_aliran' => 'JUALAN/PEROLEHAN',
            'status_kategori_aliran' => 'aktif'
        ]);

        KategoriAliran::create([
            'jenis_aliran' => 'tunai_masuk',
            'bahagian' => '1',
            'nama_kategori_aliran' => 'DEPOSIT JUALAN',
            'status_kategori_aliran' => 'aktif'
        ]);

        KategoriAliran::create([
            'jenis_aliran' => 'tunai_masuk',
            'bahagian' => '1',
            'nama_kategori_aliran' => 'PULANGAN BELIAN',
            'status_kategori_aliran' => 'aktif'
        ]);

        KategoriAliran::create([
            'jenis_aliran' => 'tunai_masuk',
            'bahagian' => '1',
            'nama_kategori_aliran' => 'STOK AKHIR',
            'status_kategori_aliran' => 'aktif'
        ]);
        
        KategoriAliran::create([
            'jenis_aliran' => 'tunai_masuk',
            'bahagian' => '2',
            'nama_kategori_aliran' => 'HASIL SEWAAN',
            'status_kategori_aliran' => 'aktif'
        ]);
        KategoriAliran::create([
            'jenis_aliran' => 'tunai_masuk',
            'bahagian' => '2',
            'nama_kategori_aliran' => 'HASIL DIVIDEN',
            'status_kategori_aliran' => 'aktif'
        ]);
        KategoriAliran::create([
            'jenis_aliran' => 'tunai_masuk',
            'bahagian' => '2',
            'nama_kategori_aliran' => 'HASIL KOMISEN',
            'status_kategori_aliran' => 'aktif'
        ]);
        KategoriAliran::create([
            'jenis_aliran' => 'tunai_masuk',
            'bahagian' => '2',
            'nama_kategori_aliran' => 'HASIL LAIN',
            'status_kategori_aliran' => 'aktif'
        ]);
        KategoriAliran::create([
            'jenis_aliran' => 'tunai_keluar',
            'bahagian' => '3',
            'nama_kategori_aliran' => 'BELIAN',
            'status_kategori_aliran' => 'aktif'
        ]);

        KategoriAliran::create([
            'jenis_aliran' => 'tunai_keluar',
            'bahagian' => '3',
            'nama_kategori_aliran' => 'DEPOSIT BELIAN',
            'status_kategori_aliran' => 'aktif'
        ]);

        KategoriAliran::create([
            'jenis_aliran' => 'tunai_keluar',
            'bahagian' => '3',
            'nama_kategori_aliran' => 'PULANGAN JUALAN',
            'status_kategori_aliran' => 'aktif'
        ]);

        KategoriAliran::create([
            'jenis_aliran' => 'tunai_keluar',
            'bahagian' => '3',
            'nama_kategori_aliran' => 'STOK AWAL',
            'status_kategori_aliran' => 'aktif'
        ]);

        KategoriAliran::create([
            'jenis_aliran' => 'tunai_keluar',
            'bahagian' => '3',
            'nama_kategori_aliran' => 'KOS PENGEPOSAN',
            'status_kategori_aliran' => 'aktif'
        ]);

        KategoriAliran::create([
            'jenis_aliran' => 'tunai_keluar',
            'bahagian' => '3',
            'nama_kategori_aliran' => 'KOS ALAT TULIS',
            'status_kategori_aliran' => 'aktif'
        ]);

        KategoriAliran::create([
            'jenis_aliran' => 'tunai_keluar',
            'bahagian' => '3',
            'nama_kategori_aliran' => 'BAYARAN SEWA',
            'status_kategori_aliran' => 'aktif'
        ]);

        KategoriAliran::create([
            'jenis_aliran' => 'tunai_keluar',
            'bahagian' => '3',
            'nama_kategori_aliran' => 'UPAH/GAJI PEKERJA',
            'status_kategori_aliran' => 'aktif'
        ]);

        KategoriAliran::create([
            'jenis_aliran' => 'tunai_keluar',
            'bahagian' => '3',
            'nama_kategori_aliran' => 'UPAH/GAJI SENDIRI',
            'status_kategori_aliran' => 'aktif'
        ]);

        KategoriAliran::create([
            'jenis_aliran' => 'tunai_keluar',
            'bahagian' => '3',
            'nama_kategori_aliran' => 'KWSP/SOCSO',
            'status_kategori_aliran' => 'aktif'
        ]);

        KategoriAliran::create([
            'jenis_aliran' => 'tunai_keluar',
            'bahagian' => '3',
            'nama_kategori_aliran' => 'BAYARAN BIL (UTILITI)',
            'status_kategori_aliran' => 'aktif'
        ]);

        KategoriAliran::create([
            'jenis_aliran' => 'tunai_keluar',
            'bahagian' => '3',
            'nama_kategori_aliran' => 'PETROL/TOL/PARKING',
            'status_kategori_aliran' => 'aktif'
        ]);

        KategoriAliran::create([
            'jenis_aliran' => 'tunai_keluar',
            'bahagian' => '3',
            'nama_kategori_aliran' => 'PENYELENGGARAAN',
            'status_kategori_aliran' => 'aktif'
        ]);

        KategoriAliran::create([
            'jenis_aliran' => 'tunai_keluar',
            'bahagian' => '3',
            'nama_kategori_aliran' => 'BELIAN ASET',
            'status_kategori_aliran' => 'aktif'
        ]);

        KategoriAliran::create([
            'jenis_aliran' => 'tunai_keluar',
            'bahagian' => '3',
            'nama_kategori_aliran' => 'BAYARAN KOMISEN',
            'status_kategori_aliran' => 'aktif'
        ]);

        KategoriAliran::create([
            'jenis_aliran' => 'tunai_keluar',
            'bahagian' => '3',
            'nama_kategori_aliran' => 'CUKAI/ZAKAT',
            'status_kategori_aliran' => 'aktif'
        ]);

        KategoriAliran::create([
            'jenis_aliran' => 'tunai_keluar',
            'bahagian' => '3',
            'nama_kategori_aliran' => 'PEMBAYARAN PINJAMAN',
            'status_kategori_aliran' => 'aktif'
        ]);

        KategoriAliran::create([
            'jenis_aliran' => 'tunai_keluar',
            'bahagian' => '3',
            'nama_kategori_aliran' => 'BAYARAN LAIN',
            'status_kategori_aliran' => 'aktif'
        ]);

        
    }
}
