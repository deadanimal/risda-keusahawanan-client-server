<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\JenisInsentif;
class JenisInsentifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisInsentif::create([
            'id_jenis_insentif' => 'JI01',
            'nama_insentif' => 'AET (INSENTIF START-UP INDIVIDU)',
            'status' => 'aktif'
        ]);

        JenisInsentif::create([
            'id_jenis_insentif' => 'JI02',
            'nama_insentif' => 'AET (INSENTIF START-UP INTEGRATOR)',
            'status' => 'aktif'
        ]);

        JenisInsentif::create([
            'id_jenis_insentif' => 'JI03',
            'nama_insentif' => 'AET (INSENTIF NANO)',
            'status' => 'aktif'
        ]);

        JenisInsentif::create([
            'id_jenis_insentif' => 'JI04',
            'nama_insentif' => 'AET (AKTIVITI EKONOMI TAMBAHAN)',
            'status' => 'aktif'
        ]);

        JenisInsentif::create([
            'id_jenis_insentif' => 'JI05',
            'nama_insentif' => 'RISSMARTMOBILE',
            'status' => 'aktif'
        ]);

        JenisInsentif::create([
            'id_jenis_insentif' => 'JI06',
            'nama_insentif' => 'GROOM BIG',
            'status' => 'aktif'
        ]);

        JenisInsentif::create([
            'id_jenis_insentif' => 'JI07',
            'nama_insentif' => 'RISSMART RETAIL/ BORONG',
            'status' => 'aktif'
        ]);

        JenisInsentif::create([
            'id_jenis_insentif' => 'JI08',
            'nama_insentif' => 'PERSIJILAN HALAL',
            'status' => 'aktif'
        ]);

        JenisInsentif::create([
            'id_jenis_insentif' => 'JI09',
            'nama_insentif' => 'PEMBUNGKUSAN DAN PELABELAN',
            'status' => 'aktif'
        ]);
        
        JenisInsentif::create([
            'id_jenis_insentif' => 'JI10',
            'nama_insentif' => 'SDSI',
            'status' => 'aktif'
        ]);

        JenisInsentif::create([
            'id_jenis_insentif' => 'JI11',
            'nama_insentif' => 'KURSUS ASAS KEUSAHAWANAN',
            'status' => 'aktif'
        ]);

        JenisInsentif::create([
            'id_jenis_insentif' => 'JI12',
            'nama_insentif' => 'A25	KURSUS - KURSUS LAIN',
            'status' => 'aktif'
        ]);

        JenisInsentif::create([
            'id_jenis_insentif' => 'JI13',
            'nama_insentif' => 'LAMAN KEBUN',
            'status' => 'aktif'
        ]);

        JenisInsentif::create([
            'id_jenis_insentif' => 'JI14',
            'nama_insentif' => 'KARNIVAL USAHAWAN',
            'status' => 'aktif'
        ]);

        JenisInsentif::create([
            'id_jenis_insentif' => 'JI15',
            'nama_insentif' => 'A28	PROGRAM RAKAN NIAGA',
            'status' => 'aktif'
        ]);

        JenisInsentif::create([
            'id_jenis_insentif' => 'JI16',
            'nama_insentif' => 'PROGRAM MENTOR MENTEE',
            'status' => 'aktif'
        ]);

        JenisInsentif::create([
            'id_jenis_insentif' => 'JI17',
            'nama_insentif' => 'PROGRAM PEMBANGUNAN VENDOR',
            'status' => 'aktif'
        ]);

        JenisInsentif::create([
            'id_jenis_insentif' => 'JI18',
            'nama_insentif' => 'PROGRAM INTEGRATOR',
            'status' => 'aktif'
        ]);

        JenisInsentif::create([
            'id_jenis_insentif' => 'JI19',
            'nama_insentif' => 'SKIM PINJAMAN DAN BANTUAN TABUNG PEMBANGUNANAN SOSIO EKONOMI PEKEBUN KECIL (TPSEPK)',
            'status' => 'aktif'
        ]);

        JenisInsentif::create([
            'id_jenis_insentif' => 'JI20',
            'nama_insentif' => 'PROGRAM PEMASARAN ONLINE',
            'status' => 'tak aktif'
        ]);

        JenisInsentif::create([
            'id_jenis_insentif' => 'JI20A',
            'nama_insentif' => 'PROGRAM PEMASARAN ONLINE - SHOPPE',
            'status' => 'aktif'
        ]);

        JenisInsentif::create([
            'id_jenis_insentif' => 'JI20B',
            'nama_insentif' => 'PROGRAM PEMASARAN ONLINE - LAZADA',
            'status' => 'aktif'
        ]);

        JenisInsentif::create([
            'id_jenis_insentif' => 'JI20C',
            'nama_insentif' => 'PROGRAM PEMASARAN ONLINE - LAIN-LAIN',
            'status' => 'aktif'
        ]);

        JenisInsentif::create([
            'id_jenis_insentif' => 'JI21',
            'nama_insentif' => 'PROGRAM PEMASARAN DOMESTIK',
            'status' => 'tak aktif'
        ]);

        JenisInsentif::create([
            'id_jenis_insentif' => 'JI21A',
            'nama_insentif' => 'PROGRAM PEMASARAN DOMESTIK - PETRONAS',
            'status' => 'aktif'
        ]);

        JenisInsentif::create([
            'id_jenis_insentif' => 'JI21B',
            'nama_insentif' => 'PROGRAM PEMASARAN DOMESTIK - PETRON',
            'status' => 'aktif'
        ]);

        JenisInsentif::create([
            'id_jenis_insentif' => 'JI21C',
            'nama_insentif' => 'PROGRAM PEMASARAN DOMESTIK - HYPERMARKET',
            'status' => 'aktif'
        ]);

        JenisInsentif::create([
            'id_jenis_insentif' => 'JI21D',
            'nama_insentif' => 'PROGRAM PEMASARAN DOMESTIK - LAIN-LAIN',
            'status' => 'aktif'
        ]);

        JenisInsentif::create([
            'id_jenis_insentif' => 'JI22',
            'nama_insentif' => 'PROGRAM PEMASARAN GLOBAL',
            'status' => 'aktif'
        ]);

        JenisInsentif::create([
            'id_jenis_insentif' => 'JI23',
            'nama_insentif' => 'PROGRAM KPLB',
            'status' => 'tak aktif'
        ]);

        JenisInsentif::create([
            'id_jenis_insentif' => 'JI23A',
            'nama_insentif' => 'PROGRAM KPLB - PPP',
            'status' => 'aktif'
        ]);

        JenisInsentif::create([
            'id_jenis_insentif' => 'JI23B',
            'nama_insentif' => 'PROGRAM KPLB - SPKLBB',
            'status' => 'aktif'
        ]);

        JenisInsentif::create([
            'id_jenis_insentif' => 'JI23C',
            'nama_insentif' => 'PROGRAM KPLB - RMEB',
            'status' => 'aktif'
        ]);

        JenisInsentif::create([
            'id_jenis_insentif' => 'JI23D',
            'nama_insentif' => 'PROGRAM KPLB - START RIGHT',
            'status' => 'aktif'
        ]);

        JenisInsentif::create([
            'id_jenis_insentif' => 'JI23E',
            'nama_insentif' => 'PROGRAM KPLB - RBO',
            'status' => 'aktif'
        ]);

        JenisInsentif::create([
            'id_jenis_insentif' => 'JI23F',
            'nama_insentif' => 'PROGRAM KPLB - DESAMALL',
            'status' => 'aktif'
        ]);
    }
}
