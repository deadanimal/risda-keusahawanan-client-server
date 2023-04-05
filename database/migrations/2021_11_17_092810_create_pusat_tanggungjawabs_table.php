<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePusatTanggungjawabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pusat_tanggungjawabs', function (Blueprint $table) {
            $table->id();
            $table->string('Kod_PT',12);
            $table->string('Bahagian_ID');
            $table->string('Negeri_Rkod',12);
            $table->string('keterangan',100);
            $table->string('status',2);
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
        Schema::dropIfExists('pusat_tanggungjawabs');
    }
}
