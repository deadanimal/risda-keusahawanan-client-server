<?php

namespace Database\Seeders;

use App\Models\TindakanLawatan;
use Illuminate\Database\Seeder;

class TindakanLawatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TindakanLawatan::create([
            'nama_tindakan_lawatan' => 'TIDAK MEREKOD WANG KELUAR MASUK LEBIH SEBULAN. - PERLU KEMASKINI SEKURANG2NYA SEBULAN SEKALI',
            'status_tindakan_lawatan' => 'aktif'
        ]); 
        TindakanLawatan::create([
            'nama_tindakan_lawatan' => 'PENGISIAN REKOD WANG KELUAR MASUK TIDAK TEPAT',
            'status_tindakan_lawatan' => 'aktif'
        ]); 
        TindakanLawatan::create([
            'nama_tindakan_lawatan' => 'PENGELUARAN SEMASA KURANG DARIPADA KAPASITI PENGELUARAN SEPATUTNYA',
            'status_tindakan_lawatan' => 'aktif'
        ]);
        TindakanLawatan::create([
            'nama_tindakan_lawatan' => 'PERLU TAMBAH CHANNEL PEMASARANMAKLUMAT PEKEBUN KECIL YANG DIPERLUKAN',
            'status_tindakan_lawatan' => 'aktif'
        ]);
    }
}
