<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();

            $table->integer('perniagaanid');
            $table->string('jenamaproduk',150);
            $table->string('unitmatrik',12);
            $table->string('kapasitimaksimum',50);
            $table->string('kapasitisemasa',50);
            $table->string('hargaperunit',250);
            $table->string('modified_by',50);

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
        Schema::dropIfExists('produks');
    }
}
