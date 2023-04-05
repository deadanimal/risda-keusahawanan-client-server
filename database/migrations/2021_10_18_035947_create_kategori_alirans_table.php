<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriAliransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_alirans', function (Blueprint $table) {
            $table->id();

            $table->string('jenis_aliran', 50);
            $table->string('bahagian', 50);
            $table->string('nama_kategori_aliran', 50);
            $table->string('status_kategori_aliran', 12);
            
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
        Schema::dropIfExists('kategori_alirans');
    }
}
