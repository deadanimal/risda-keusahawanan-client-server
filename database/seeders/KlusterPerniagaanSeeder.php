<?php

namespace Database\Seeders;

use App\Models\KlusterPerniagaan;
use Illuminate\Database\Seeder;

class KlusterPerniagaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KlusterPerniagaan::truncate();
  
        $csvFile = fopen(base_path("database/data/kluster_perniagaan.csv"), "r");
  
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                KlusterPerniagaan::create([
                    "kluster_id" => $data['0'],
                    "nama_kluster" => $data['1'],
                    "jenis_kluster" => $data['2']
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);
    }
}
