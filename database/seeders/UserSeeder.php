<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        User::create([
            'name'=> 'RUZLAN BIN ABDUL RAHMAN',
            'email'=> 'ruzlan@risda.gov.my',
            'password'=> Hash::make('password'),
            'idpegawai'=>'1',
            'no_kp'=>'123456789015',
            'status_pengguna'=>'1',
            'role'=>'1',
            'type'=>'1'
        ]);

        User::create([
            'name'=> 'ABD ZAHID BIN HAJI AHMAD',
            'email'=> 'abdzahid@risda.gov.my',
            'password'=> Hash::make('password'),
            'idpegawai'=>'2',
            'no_kp'=>'670210000000',
            'status_pengguna'=>'1',
            'role'=>'1',
            'type'=>'1',
            
        ]);

        User::create([
            'name'=> 'ABDUL HALIM BIN ABU HASSAN',
            'email'=> 'a.halim@risda.gov.my',
            'password'=> Hash::make('password'),
            'idpegawai'=>'3',
            'no_kp'=>'700510000001',
            'status_pengguna'=>'1',
            'role'=>'1',
            'type'=>'1'
        ]);


        User::create([
            'name'=> 'MAHANUM BT MAT RIPING',
            'email'=> 'mahanum@risda.gov.my',
            'password'=> Hash::make('password'),
            'idpegawai'=>'4',
            'no_kp'=>'700510000000',
            'status_pengguna'=>'1',
            'role'=>'1',
            'type'=>'1'
        ]);
        
        $csvFile = fopen(base_path("database/data/User.csv"), "r");
  
        $firstline = true;
        while (($data = fgetcsv($csvFile, 15000, ",")) !== FALSE) {
            if (!$firstline) {
                DB::table('users')->insert([
                    "usahawanid" => $data['0'],
                    "name" => $data['1'],
                    "no_kp" => $data['2'],
                    "email" => $data['3'],
                    "type" => $data['4'],
                    "profile_status" => $data['5'],
                    "status_pengguna" => $data['6']
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);
    }
}
