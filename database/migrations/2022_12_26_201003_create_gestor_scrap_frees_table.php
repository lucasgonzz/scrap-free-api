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
            $table->integer('num');
            $table->string('nombre')->nullable();
            $table->string('nombre_formal')->nullable();
            $table->string('celular')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('svg')->nullable();
            $table->integer('unidad_negocio_id')->nullable();
            $table->foreignId('user_id');
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
