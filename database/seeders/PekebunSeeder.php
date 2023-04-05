<?php

namespace Database\Seeders;

use App\Models\Pekebun;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PekebunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pekebuns')->truncate();

        $csvFile = fopen(base_path("database/data/Pekebun.csv"), "r");
  
        $firstline = true;
        while (($data = fgetcsv($csvFile, 15000, ",")) !== FALSE) {
            if (!$firstline) {
                DB::table('pekebuns')->insert([
                    "usahawanid" => $data['0'],
                    "noTS" => $data['1'],
                    "nama_PK" => $data['2'],
                    "No_KP" => $data['3']
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);
    }
}
