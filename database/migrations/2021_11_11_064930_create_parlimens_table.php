<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParlimensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parlimens', function (Blueprint $table) {
            $table->id();
            $table->string('U_Parlimen_ID',20);
            $table->string('Parlimen',100);
            $table->string('U_Negeri_ID',12);
            $table->string('Kod_Parlimen',12)->nullable();
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
        Schema::dropIfExists('parlimens');
    }
}
