<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMukimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mukims', function (Blueprint $table) {
            $table->id();
            $table->string('U_Mukim_ID',12);
            $table->string('Mukim',100);
            $table->string('Kod_Mukim',12)->nullable();
            $table->string('U_Negeri_ID',12);
            $table->string('Kod_Negeri',12)->nullable();
            $table->string('U_Daerah_ID',12);
            $table->string('Kod_Daerah',12)->nullable();
            $table->string('Stesen_kod',12);
            $table->boolean('status',2);
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
        Schema::dropIfExists('mukims');
    }
}
