<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeksyensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seksyens', function (Blueprint $table) {
            $table->id();
            $table->string('U_Seksyen_ID',20);
            $table->string('Seksyen',100);
            $table->string('U_Negeri_ID',12);
            $table->string('U_Daerah_ID',12);
            $table->string('U_Mukim_ID',20);
            $table->string('status',2);
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
        Schema::dropIfExists('seksyens');
    }
}
