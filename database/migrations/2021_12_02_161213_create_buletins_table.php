<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuletinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buletins', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_pegawai');
            $table->string('tajuk');
            $table->dateTime('tarikh')->nullable();
            $table->longText('keterangan_lain')->nullable();
            $table->string('url')->nullable();
            $table->string('status');
            $table->longText('gambar_buletin');

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
        Schema::dropIfExists('buletins');
    }
}
