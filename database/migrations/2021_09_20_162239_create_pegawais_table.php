<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();

            $table->string('nokp',14);
            $table->string('nama',100);
            $table->string('nopekerja',6);
            $table->string('GelaranJwtn',500);
            $table->string('NamaPT',100);
            $table->string('NamaPA',100);
            $table->string('NamaUnit',255);
            $table->string('Jawatan',300);
            $table->string('StesenBertugas',100);
            $table->string('email',50);
            $table->string('notel',12);
            $table->string('mukim',100);
            $table->string('peranan_pegawai',12);
            $table->string('negeri',35);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawais');
    }
}
