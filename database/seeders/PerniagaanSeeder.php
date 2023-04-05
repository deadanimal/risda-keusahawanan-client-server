<?php

namespace Database\Seeders;

use App\Models\Perniagaan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerniagaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('perniagaans')->truncate();

        $csvFile = fopen(base_path("database/data/Perniagaan.csv"), "r");
  
        $firstline = true;
        while (($data = fgetcsv($csvFile, 15000, ",")) !== FALSE) {
            if (!$firstline) {
                DB::table('perniagaans')->insert([
                    "usahawanid" => $data['0'],
                    "jenisperniagaan" => $data['1'],
                    "klusterperniagaan" => $data['2'],
                    "subkluster" => $data['3'],
                    "purata_jualan_bulanan" => $data['4']
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);
    }
}
