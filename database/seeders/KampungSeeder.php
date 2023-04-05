<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KampungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kampungs')->truncate();
  
        $csvFile = fopen(base_path("database/data/Kampung.csv"), "r");
  
        $firstline = true;
        while (($data = fgetcsv($csvFile, 15000, ",")) !== FALSE) {
            if (!$firstline) {
                DB::table('kampungs')->insert([
                    "U_Kampung_ID" => $data['0'],
                    "Kampung" => $data['1'],
                    "Kod_Kampung" => $data['2'],
                    "U_Negeri_ID" => $data['3'],
                    "Kod_Negeri" => $data['4'],
                    "U_Daerah_ID" => $data['5'],
                    "Kod_Daerah" => $data['6'],
                    "U_Mukim_ID" => $data['7'],
                    "Kod_Mukim" => $data['8'],
                    "Stesen_kod" => $data['9'],
                    "status" => $data['10'],
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);
    }
}
