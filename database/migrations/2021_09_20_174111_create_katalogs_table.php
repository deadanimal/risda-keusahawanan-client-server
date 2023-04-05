<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('katalogs', function (Blueprint $table) {
            $table->id();

            $table->integer('id_pengguna');
            $table->string('nama_produk',50);
            $table->string('kandungan_produk',50);
            $table->string('harga_produk',4);
            $table->string('berat_produk',50);

            // $table->double('kos_per_unit',10,2);
            $table->string('keterangan_produk',30);
            $table->longText('gambar_url')->nullable();
            $table->double('baki_stok',30,2)->nullable();
            $table->string('unit_production',50);
            $table->string('status_katalog',10)->nullable();

            $table->integer('disahkan_oleh')->nullable();
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
        Schema::dropIfExists('katalogs');
    }
}
