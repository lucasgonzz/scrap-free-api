<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGestorScrapFreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gestor_scrap_frees', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('celular')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->foreignId('unidad_negocios_id')->constrained()->nullable();
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
        Schema::dropIfExists('gestor_scrap_frees');
    }
}
