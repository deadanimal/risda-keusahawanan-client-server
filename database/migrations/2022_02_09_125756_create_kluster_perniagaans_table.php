<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKlusterPerniagaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kluster_perniagaans', function (Blueprint $table) {
            $table->id();
            $table->string('kluster_id')->nullable();
            $table->string('nama_kluster')->nullable();
            $table->string('jenis_kluster')->nullable();
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
        Schema::dropIfExists('kluster_perniagaans');
    }
}
