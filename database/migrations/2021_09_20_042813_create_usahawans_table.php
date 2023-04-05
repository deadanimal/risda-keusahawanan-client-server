<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsahawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usahawans', function (Blueprint $table) {
            $table->id();
            $table->string('usahawanid')->nullable();
            $table->string('Kod_PT',12)->nullable();
            $table->string('namausahawan',150);
            $table->string('nokadpengenalan')->nullable();
            $table->date('tarikhlahir')->nullable();
            $table->integer('U_Jantina_ID')->nullable();
            $table->string('U_Bangsa_ID',14)->nullable();
            $table->string('U_Etnik_ID')->nullable();
            $table->string('statusperkahwinan',50)->nullable();
            $table->integer('U_Pendidikan_ID')->nullable();
            $table->string('U_Taraf_Pendidikan_Tertinggi_ID')->nullable();
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
            $table->string('id_kategori_usahawan',12)->nullable();
            $table->longText('gambar_url')->nullable();

            $table->string('notelefon')->nullable();
            $table->string('nohp')->nullable();
            $table->string('email',100)->nullable();

            $table->string('status_daftar_usahawan')->nullable();

            $table->string('createdby_id',50)->nullable();
            $table->string('createdby_kod_PT',50)->nullable();
            $table->string('modifiedby_id',50)->nullable();
            $table->string('modifiedby_kod_PT',50)->nullable();
            
            $table->integer('status_profil')->nullable()->default(0);
            
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
        Schema::dropIfExists('usahawans');
    }
}
