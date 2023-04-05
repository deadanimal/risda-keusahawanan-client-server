<?php

namespace Database\Seeders;

use App\Models\Usahawan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsahawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usahawans')->truncate();
        
        $csvFile = fopen(base_path("database/data/Usahawan.csv"), "r");
        DB::statement('SET IDENTITY_INSERT usahawans ON');
        $firstline = true;
        while (($data = fgetcsv($csvFile, 15000, ",")) !== FALSE) {
            if (!$firstline) {
                DB::table('usahawans')->insert([
                    "id" => $data['0'],
                    "usahawanid" => $data['1'],
                    "Kod_PT" => $data['2'],
                    "namausahawan" => $data['3'],
                    "nokadpengenalan" => $data['4'],
                    "tarikhlahir" => $data['5'],
                    "U_Jantina_ID" => $data['6'],
                    "U_Bangsa_ID" => $data['7'],
                    "statusperkahwinan" => $data['8'],
                    "notelefon" => $data['9'],
                    "nohp" => $data['10'],
                    "U_Pendidikan_ID" => $data['11'],
                    "email" => $data['12'],
                    "alamat1" => $data['13'],
                    "alamat2" => $data['14'],
                    "alamat3" => $data['15'],
                    "bandar" => $data['16'],
                    "poskod" => $data['17'],
                    "U_Daerah_ID" => $data['18'],
                    "U_Negeri_ID" => $data['19'],
                    "U_Parlimen_ID" => $data['20'],
                    "U_Dun_ID" => $data['21'],
                    "status_daftar_usahawan" => $data['22'],
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);
    }
}
