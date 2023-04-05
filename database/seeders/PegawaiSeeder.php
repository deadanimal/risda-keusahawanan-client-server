<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Pegawai;
class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pegawai::create([
            'nokp'=>'621003065611',
            'nama'=> 'RUZLAN BIN ABDUL RAHMAN',
            'nopekerja'=> '71829',
            'GelaranJwtn'=> '11001H11',
            'NamaPT'=> '428699',
            'NamaPA'=> '',
            'NamaUnit'=> '',
            'Jawatan'=> '',
            'StesenBertugas'=> '',
            'email'=> 'ruzlan@risda.gov.my',
            'notel'=> '',
            'mukim'=> '020740',
            'peranan_pegawai'=> '',
        ]);

        Pegawai::create([
            'nokp'=>'670210000000',
            'nama'=> 'ABD ZAHID BIN HAJI AHMAD',
            'nopekerja'=> '63276',
            'GelaranJwtn'=> '41018N01',
            // 'NamaPT'=> '223199',
            'NamaPT'=> '427199',
            'NamaPA'=> '',
            'NamaUnit'=> '',
            'Jawatan'=> '',
            'StesenBertugas'=> '',
            'email'=> 'abdzahid@risda.gov.my',
            'notel'=> '',
            'mukim'=> '010101',
            'peranan_pegawai'=> '',
        ]);

        Pegawai::create([
            'nokp'=>'700510000000',
            'nama'=> 'ABDUL HALIM BIN ABU HASSAN',
            'nopekerja'=> '70239',
            'GelaranJwtn'=> '22003W03',
            // 'NamaPT'=> '423199',
            'NamaPT'=> '427199',
            'NamaPA'=> '',
            'NamaUnit'=> '',
            'Jawatan'=> '',
            'StesenBertugas'=> '',
            'email'=> 'a.halim@risda.gov.my',
            'notel'=> '',
            'mukim'=> '010101',
            'peranan_pegawai'=> '',
        ]);

        Pegawai::create([
            'nokp'=>'750720000000',
            'nama'=> 'MAHANUM BT MAT RIPING',
            'nopekerja'=> '70920',
            'GelaranJwtn'=> '19003N06',
            'NamaPT'=> '430799',
            'NamaPA'=> '',
            'NamaUnit'=> '',
            'Jawatan'=> '',
            'StesenBertugas'=> '',
            'email'=> 'mahanum@risda.gov.my',
            'notel'=> '',
            'mukim'=> '010101',
            'peranan_pegawai'=> '',
        ]);
    }
}
