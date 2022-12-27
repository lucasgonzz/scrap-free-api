<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolizasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polizas', function (Blueprint $table) {
            $table->id();
            $table->integer('num')->nullable();
            $table->foreignId('asegurado_id')->constrained()->nullable();
            $table->foreignId('tipo_producto_de_seguro_id')->constrained()->nullable();
            $table->foreignId('ramo_id')->constrained()->nullable();
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
        Schema::dropIfExists('polizas');
    }
}
