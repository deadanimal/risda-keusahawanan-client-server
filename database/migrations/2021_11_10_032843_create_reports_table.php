<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('type',250)->nullable();
            $table->string('tab1',250)->nullable();
            $table->string('tab2',250)->nullable();
            $table->string('tab3',250)->nullable();
            $table->string('tab4',250)->nullable();
            $table->string('tab5',250)->nullable();
            $table->string('tab6',250)->nullable();
            $table->string('tab7',250)->nullable();
            $table->string('tab8',250)->nullable();
            $table->string('tab9',250)->nullable();
            $table->string('tab10',250)->nullable();
            $table->string('tab11',250)->nullable();
            $table->string('tab12',250)->nullable();
            $table->string('tab13',250)->nullable();
            $table->string('tab14',250)->nullable();
            $table->string('tab15',250)->nullable();
            $table->string('tab16',250)->nullable();
            $table->string('tab17',250)->nullable();
            $table->string('tab18',250)->nullable();
            $table->string('tab19',250)->nullable();
            $table->string('tab20',250)->nullable();
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
        Schema::dropIfExists('reports');
    }
}
