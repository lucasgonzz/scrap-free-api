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
            $table->integer('asegurado_id')->nullable();
            $table->string('numero_poliza')->nullable();
            $table->integer('tipo_producto_de_seguro_id')->nullable();
            $table->integer('ramo_id')->nullable();
            $table->string('referencia')->nullable();
            $table->string('numero_asociado')->nullable();
            $table->integer('tipo_documento_id')->nullable();
            $table->string('numero_documento')->nullable();
            $table->integer('user_id')->co;
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
