<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTecnicoAseguradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tecnico_asegurados', function (Blueprint $table) {
            $table->id();
            $table->integer('num');
            $table->string('nombre');
            $table->text('direccion')->nullable();
            $table->text('notas')->nullable();
            $table->string('telefono_celular')->nullable();
            $table->string('telefono_fijo')->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('tecnico_asegurados');
    }
}
