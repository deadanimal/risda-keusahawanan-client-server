<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeranansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peranans', function (Blueprint $table) {
            $table->string('peranan_id', 1);
            $table->string('kod_peranan', 30);
            $table->string('nama_peranan');
        });

        DB::table('peranans')->insert(
            array(
                [
                    'peranan_id' => '1',
                    'kod_peranan' => 'Super Admin',
                    'nama_peranan' => 'Super Admin',
                ],
                [
                    'peranan_id' => '2',
                    'kod_peranan' => 'BPU',
                    'nama_peranan' => 'Bahagian Pembangunan Usahawan',
                ],
                [
                    'peranan_id' => '3',
                    'kod_peranan' => 'PUN',
                    'nama_peranan' => 'Penyelaras Usahawan Negeri',
                ],
                [
                    'peranan_id' => '4',
                    'kod_peranan' => 'PUD',
                    'nama_peranan' => 'Penyelaras Usahawan Daerah',
                ],
                [
                    'peranan_id' => '5',
                    'kod_peranan' => 'Kerani PUN',
                    'nama_peranan' => 'Kerani Penyelaras Usahawan Negeri',
                ],
                [
                    'peranan_id' => '6',
                    'kod_peranan' => 'Kerani PUD',
                    'nama_peranan' => 'Kerani Penyelaras Usahawan Daerah',
                ],
                [
                    'peranan_id' => '7',
                    'kod_peranan' => 'PPP',
                    'nama_peranan' => 'Penolong Pegawai Pertanian',
                ]
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peranans');
    }
}
