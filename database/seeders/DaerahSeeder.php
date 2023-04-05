<?php

namespace Database\Seeders;

use App\Models\Daerah;
use Illuminate\Database\Seeder;

class DaerahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Daerah::truncate();
  
        $csvFile = fopen(base_path("database/data/Daerah.csv"), "r");
  
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Daerah::create([
                    "U_Daerah_ID" => $data['0'],
                    "Daerah" => $data['1'],
                    "Kod_Daerah" => $data['2'],
                    "U_Negeri_ID" => $data['3'],
                    "status" => $data['4'],
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);
    }
}
