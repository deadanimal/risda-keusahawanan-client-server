<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStesensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stesens', function (Blueprint $table) {
            $table->id();
            $table->string('Stesen_kod',12);
            $table->string('U_Negeri_ID',12)->nullable();
            $table->string('keterangan',12);
            $table->string('Kod_PT',100);
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
        Schema::dropIfExists('stesens');
    }
}
