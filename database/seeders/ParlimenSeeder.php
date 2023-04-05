<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParlimenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parlimens')->truncate();
  
        $csvFile = fopen(base_path("database/data/Parlimen.csv"), "r");
  
        $firstline = true;
        while (($data = fgetcsv($csvFile, 15000, ",")) !== FALSE) {
            if (!$firstline) {
                DB::table('parlimens')->insert([
                    "U_Parlimen_ID" => $data['0'],
                    "Parlimen" => $data['1'],
                    "U_Negeri_ID" => $data['2'],
                    "Kod_Parlimen" => $data['3'],
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);
    }
}
