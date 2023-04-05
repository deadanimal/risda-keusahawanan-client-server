<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelanggansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->id();

            $table->string('tajuk');
            $table->string('nama_pelanggan',100);
            $table->string('alamat1',150);
            $table->string('alamat2',150);
            $table->string('alamat3',150);
            $table->string('poskod',50);
            $table->string('U_Negeri_ID',12);
            $table->string('U_Daerah_ID',12);
            $table->string('no_telefon',12);
            $table->string('no_fax',12)->nullable();

            $table->string('cukai_sst')->nullable();
            $table->string('kos_penghantaran')->nullable();
            $table->string('diskaun')->nullable();
            
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
        Schema::dropIfExists('pelanggans');
    }
}
