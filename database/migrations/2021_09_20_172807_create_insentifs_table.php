<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsentifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insentifs', function (Blueprint $table) {
            $table->id();

            $table->string('id_pengguna')->nullable();
            $table->string('id_jenis_insentif')->nullable();

            $table->string('tahun_terima_insentif',4)->nullable();
            $table->double('nilai_insentif',30,2)->nullable();
            $table->string('created_by',50)->nullable();
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
        Schema::dropIfExists('insentifs');
    }
}
