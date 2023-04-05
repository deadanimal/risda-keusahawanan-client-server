<?php

namespace Database\Seeders;

use App\Models\Dun;
use Illuminate\Database\Seeder;

class DunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dun::truncate();
  
        $csvFile = fopen(base_path("database/data/Dun.csv"), "r");
  
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Dun::create([
                    "U_Dun_ID" => $data['0'],
                    "Dun" => $data['1'],
                    "U_Parlimen_ID" => $data['2'],
                    "Kod_Dun" => $data['3'],
                    "Kod_Parlimen" => $data['4'],
                    "Kod_Negeri" => $data['5'],
                    "Kod_Dun2" => $data['6'],
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);
    }
}
