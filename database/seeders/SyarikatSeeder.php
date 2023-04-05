<?php

namespace Database\Seeders;

use App\Models\Syarikat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SyarikatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('syarikats')->truncate();

        $csvFile = fopen(base_path("database/data/Syarikat.csv"), "r");
  
        $firstline = true;
        while (($data = fgetcsv($csvFile, 15000, ",")) !== FALSE) {
            if (!$firstline) {
                DB::table('syarikats')->insert([
                    "usahawanid" => $data['0'],
                    "namasyarikat" => $data['1'],
                    "nodaftarssm" => $data['2'],
                    "tahunmulaoperasi" => $data['3'],
                    "bilanganpekerja" => $data['4'],
                    "alamat1_ssm" => $data['5'],
                    "alamat2_ssm" => $data['6'],
                    "alamat3_ssm" => $data['7']
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);
    }
}
