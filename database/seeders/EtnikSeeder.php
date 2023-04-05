<?php

namespace Database\Seeders;

use App\Models\Etnik;
use Illuminate\Database\Seeder;

class EtnikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Etnik::truncate();
  
        $csvFile = fopen(base_path("database/data/Etnik.csv"), "r");
  
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Etnik::create([
                    "U_Etnik_ID" => $data['0'],
                    "Etnik" => $data['1'],
                    "U_Bangsa_ID" => $data['2']
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);
    }
}
