<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerniagaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perniagaans', function (Blueprint $table) {
            $table->id();

            $table->string('usahawanid')->nullable();
            $table->string('jenisperniagaan',12)->nullable();
            $table->string('klusterperniagaan')->nullable();
            $table->string('subkluster')->nullable();
            $table->string('alamat1')->nullable();
            $table->string('alamat2')->nullable();
            $table->string('alamat3')->nullable();
            $table->string('bandar',50)->nullable();
            $table->integer('poskod')->length(5)->nullable();
            $table->string('U_Negeri_ID',12)->nullable();
            $table->string('U_Daerah_ID',12)->nullable();
            $table->string('U_Mukim_ID',12)->nullable();
            $table->string('U_Parlimen_ID',12)->nullable();
            $table->string('U_Dun_ID',12)->nullable();
            $table->string('U_Kampung_ID',12)->nullable();
            $table->string('U_Seksyen_ID',12)->nullable();
            $table->string('latitud',20)->nullable();
            $table->string('logitud',20)->nullable();
            $table->string('facebook',50)->nullable();
            $table->string('instagram',50)->nullable();
            $table->string('twitter',50)->nullable();
            $table->string('lamanweb',50)->nullable();
            $table->integer('dropship')->nullable();
            $table->integer('ejen')->nullable();
            $table->integer('stokis')->nullable();
            $table->integer('outlet')->nullable();
            $table->string('domestik',50)->nullable();
            $table->string('luarnegara',50)->nullable();
            $table->string('pasaranonline',12)->nullable();
            $table->double('purata_jualan_bulanan',12,2)->nullable();
            $table->double('peratus_kenaikan',12,2)->nullable();
            $table->double('hasil_jualan_tahunan',12,2)->nullable();
            $table->string('gambar_url',150)->nullable();
            $table->string('createdby_id',50)->nullable();
            $table->string('createdby_kod_PT',50)->nullable();
            $table->string('modifiedby_id',50)->nullable();
            $table->string('modifiedby_kod_PT',50)->nullable();
            
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
        Schema::dropIfExists('perniagaans');
    }
}
