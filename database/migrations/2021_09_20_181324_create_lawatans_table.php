<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLawatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lawatans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_pengguna')->nullable();
            $table->foreignId('id_pegawai')->nullable();
            $table->foreignId('id_tindakan_lawatan')->nullable();

            $table->string('jenis_lawatan',15)->nullable();
            $table->date('tarikh_lawatan')->nullable();
            $table->time('masa_lawatan')->nullable();
            $table->string('status_lawatan')->nullable();
            $table->longText('gambar_lawatan')->nullable();
            $table->string('komen')->nullable();
            $table->string('modified_by',50)->nullable();
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
        Schema::dropIfExists('lawatans');
    }
}
