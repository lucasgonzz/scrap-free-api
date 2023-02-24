<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiniestroPatrimonialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siniestro_patrimonials', function (Blueprint $table) {
            $table->id();
            $table->string('siniestro', 120)->nullable();
            $table->text('titular_poliza')->nullable();
            $table->string('causa', 120)->nullable();
            $table->string('fecha_denuncia', 120)->nullable();
            $table->text('estado_situacion')->nullable();
            $table->text('estado_siniestro')->nullable();
            $table->text('log_auditoria')->nullable();
            $table->text('cobertura_1')->nullable();
            $table->text('ded_1')->nullable();
            $table->text('cobertura_2')->nullable();
            $table->text('ded_2')->nullable();
            $table->text('cobertura_3')->nullable();
            $table->text('ded_3')->nullable();
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
        Schema::dropIfExists('siniestro_patrimonials');
    }
}
