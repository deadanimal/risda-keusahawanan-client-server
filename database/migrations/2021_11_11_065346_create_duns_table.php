<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('duns', function (Blueprint $table) {
            $table->id();
            $table->string('U_Dun_ID',20);
            $table->string('Dun',100);
            $table->string('U_Parlimen_ID',20);
            $table->string('Kod_Dun',20);
            $table->string('Kod_Parlimen',12);
            $table->string('Kod_Negeri',12);
            $table->string('Kod_Dun2',12);
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
        Schema::dropIfExists('duns');
    }
}
