<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadNegociosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidad_negocios', function (Blueprint $table) {
            $table->id();
            $table->integer('num');
            $table->text('nombre');
            $table->foreignId('aseguradora_id')->nullable()->constrained();
            $table->text('email')->nullable();
            $table->text('domicilio')->nullable();
            $table->text('notas')->nullable();
            $table->text('responsable')->nullable();
            $table->text('telefono_conmutador')->nullable();
            $table->integer('user_id');
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
        Schema::dropIfExists('unidad_negocios');
    }
}
