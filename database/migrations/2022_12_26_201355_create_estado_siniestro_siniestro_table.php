<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadoSiniestroSiniestroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_siniestro_siniestro', function (Blueprint $table) {
            $table->id();
            $table->integer('estado_siniestro_id')->nullable();
            $table->integer('siniestro_id')->nullable();
            $table->integer('dias_en_estado_siniestro')->nullable();
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
        Schema::dropIfExists('estado_siniestro_siniestro');
    }
}
