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
            $table->foreignId('estado_siniestro_id')->nullable()->constrained();
            $table->foreignId('siniestro_id')->nullable()->constrained();
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
