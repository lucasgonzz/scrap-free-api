<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadoSiniestrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_siniestros', function (Blueprint $table) {
            $table->id();
            $table->integer('num');
            $table->string('nombre');
            $table->decimal('codigo', 12,2)->nullable();
            $table->text('descripcion')->nullable();
            $table->string('enviar_mensaje_function')->nullable();
            $table->boolean('por_defecto_en_estados_que_coinciden')->default(0);
            $table->boolean('por_defecto_en_estados_actualmente')->default(0);
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
        Schema::dropIfExists('estado_siniestros');
    }
}
