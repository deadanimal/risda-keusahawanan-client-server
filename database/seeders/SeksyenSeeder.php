<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeksyenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seksyens')->truncate();
  
        $csvFile = fopen(base_path("database/data/Seksyen.csv"), "r");
  
        $firstline = true;
        while (($data = fgetcsv($csvFile, 15000, ",")) !== FALSE) {
            if (!$firstline) {
                DB::table('seksyens')->insert([
                    "U_Seksyen_ID" => $data['0'],
                    "Seksyen" => $data['1'],
                    "U_Negeri_ID" => $data['2'],
                    "U_Daerah_ID" => $data['3'],
                    "U_Mukim_ID" => $data['4'],
                    "status" => $data['5'],
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);
    }
}
