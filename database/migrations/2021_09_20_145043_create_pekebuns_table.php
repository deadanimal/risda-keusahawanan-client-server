<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePekebunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pekebuns', function (Blueprint $table) {
            $table->id();

            $table->string('usahawanid',50);
            $table->string('status_daftar_usahawan',50)->nullable();
            $table->string('Nama_PK',250)->nullable();
            $table->string('No_KP',50)->nullable();

            // $table->string('noTS');
           

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
        Schema::dropIfExists('pekebuns');
    }
}
