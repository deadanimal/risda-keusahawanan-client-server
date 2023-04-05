<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisPerniagaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_perniagaans', function (Blueprint $table) {
            $table->id();
            $table->string('kod_jenis_perniagaan',12);
            $table->string('nama_jenis_perniagaan',100);
            $table->string('status',12);
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
        Schema::dropIfExists('jenis_perniagaans');
    }
}
