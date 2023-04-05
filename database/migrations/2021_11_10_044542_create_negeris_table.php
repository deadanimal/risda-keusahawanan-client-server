<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNegerisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negeris', function (Blueprint $table) {
            $table->id();
            $table->string('U_Negeri_ID',12);
            $table->string('Negeri',100);
            $table->string('Kod_Negeri',12)->nullable();
            $table->string('Negeri_Rkod',12);
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
        Schema::dropIfExists('negeris');
    }
}
