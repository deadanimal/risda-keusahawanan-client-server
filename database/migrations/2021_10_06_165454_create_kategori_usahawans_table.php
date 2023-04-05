<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriUsahawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_usahawans', function (Blueprint $table) {
            $table->id();
            $table->string('id_kategori_usahawan', 50);
            $table->string('nama_kategori_usahawan', 50);
            $table->string('jualan_usahawan_min', 50);
            $table->string('jualan_usahawan_max', 50);
            $table->string('status_kategori_usahawan', 50);
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
        Schema::dropIfExists('kategori_usahawans');
    }
}
