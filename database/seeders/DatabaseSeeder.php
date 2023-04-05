<?php

namespace Database\Seeders;

use App\Models\Daerah;
use App\Models\KlusterPerniagaan;
use App\Models\Parlimen;
use App\Models\Usahawan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            UsahawanSeeder::class,
            PerniagaanSeeder::class,
            SyarikatSeeder::class,
            PekebunSeeder::class,
            KategoriAliranSeeder::class,
            PegawaiSeeder::class,
            JenisInsentifSeeder::class,
            KategoriUsahawanSeeder::class,
            TindakanLawatanSeeder::class,
            DaerahSeeder::class,
            DunSeeder::class,
            KampungSeeder::class,
            JenisPerniagaanSeeder::class,
            MukimSeeder::class,
            NegeriSeeder::class,
            ParlimenSeeder::class,
            PusatTanggungjawabSeeder::class,
            SeksyenSeeder::class,
            EtnikSeeder::class,
            KlusterPerniagaanSeeder::class
        ]);
    }
}
