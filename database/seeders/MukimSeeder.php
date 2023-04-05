<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MukimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mukims')->truncate();
  
        $csvFile = fopen(base_path("database/data/Mukim.csv"), "r");
  
        $firstline = true;
        while (($data = fgetcsv($csvFile, 15000, ",")) !== FALSE) {
            if (!$firstline) {
                DB::table('mukims')->insert([
                    "U_Mukim_ID" => $data['0'],
                    "Mukim" => $data['1'],
                    "Kod_Mukim" => $data['2'],
                    "U_Negeri_ID" => $data['3'],
                    "Kod_Negeri" => $data['4'],
                    "U_Daerah_ID" => $data['5'],
                    "Kod_Daerah" => $data['6'],
                    "Stesen_kod" => $data['7'],
                    "status" => $data['8'],
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);
    }
}
