<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSyarikatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('syarikats', function (Blueprint $table) {
            $table->id();

            $table->string('usahawanid');

            $table->string('namasyarikat',150)->nullable();
            $table->string('jenismilikanperniagaan',12)->nullable();
            $table->string('nodaftarssm',50)->nullable();
            
            $table->string('nodaftarpbt',50)->nullable();
            $table->string('nodaftarpersijilanhalal',50)->nullable();
            $table->string('nodaftarmesti',50)->nullable();

            $table->string('tahunmulaoperasi',4)->nullable();
            $table->integer('bilanganpekerja')->nullable();

            $table->string('alamat1_ssm')->nullable();
            $table->string('alamat2_ssm')->nullable();
            $table->string('alamat3_ssm')->nullable();
            $table->date('tarikh_mula_mof')->nullable();
            $table->date('tarikh_tamat_mof')->nullable();
            $table->string('status_bumiputera')->nullable();
            $table->date('tarikh_daftar_ssm')->nullable();

            $table->string('notelefon',15)->nullable();
            $table->string('no_hp',15)->nullable();
            $table->string('email',100)->nullable();
            $table->longText('logo_syarikat')->nullable();
            $table->string('prefix_id',50)->nullable();

            $table->string('nama_akaun_bank')->nullable();
            $table->string('no_akaun_bank')->nullable();

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
        Schema::dropIfExists('syarikats');
    }
}
