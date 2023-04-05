<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAliransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alirans', function (Blueprint $table) {
            $table->id();

            $table->integer('id_pengguna')->nullable();
            $table->integer('id_kategori_aliran')->nullable();
            $table->date('tarikh_aliran')->nullable();
            $table->string('keterangan_aliran', 100)->nullable();
            $table->double('jumlah_aliran',30,2)->nullable();
            $table->string('kategori_aliran',50)->nullable();
            $table->string('nama_dokumen')->nullable();
            $table->string('dokumen_lampiran',150)->nullable();
            $table->string('modified_by')->nullable();


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
        Schema::dropIfExists('alirans');
    }
}
