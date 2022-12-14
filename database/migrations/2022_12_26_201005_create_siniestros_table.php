<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiniestrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siniestros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aseguradora_id')->constrained()->nullable();
            $table->foreignId('causa_siniestro_id')->constrained()->nullable();
            $table->foreignId('estado_siniestro_id')->constrained()->nullable();
            $table->foreignId('localidad_id')->constrained()->nullable();
            $table->foreignId('provincia_id')->constrained()->nullable();
            $table->foreignId('tipo_orden_de_servicio_id')->constrained()->nullable();
            $table->foreignId('gestor_scrap_free')->constrained()->nullable();
            $table->foreignId('gestor_aseguradora')->constrained()->nullable();
            $table->string('codigo_postal')->nullable();
            $table->text('comentarios_seguro')->nullable();
            $table->decimal('costo_reporte', 14,2)->nullable();
            $table->string('denunciante')->nullable();
            $table->text('foto_deposito_deducible')->nullable();
            $table->text('domicilio_completo_google')->nullable();
            $table->text('entre_calles')->nullable();
            $table->timestamp('fecha_alta_scrap_free')->nullable();
            $table->timestamp('fecha_cierre_administrativo')->nullable();
            $table->timestamp('fecha_cierre_aseguradora')->nullable();
            $table->timestamp('fecha_cierre_scrap_free')->nullable();
            $table->timestamp('fecha_denuncia')->nullable();
            $table->timestamp('fecha_ocurrencia')->nullable();
            $table->decimal('liquidacion_deducible', 14,2)->nullable();
            $table->decimal('liquidacion_siniestro', 14,2)->nullable();
            $table->text('log_auditoria')->nullable();
            $table->text('notas_domicilio')->nullable();
            $table->integer('orden_servicio')->nullable();
            $table->text('recomendacion')->nullable();
            $table->decimal('reparacion_deducible', 14,2)->nullable();
            $table->decimal('reparacion_paga_asegurado', 14,2)->nullable();
            $table->decimal('reparacion_siniestro', 14,2)->nullable();
            $table->string('numero_siniestro')->nullable();
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
        Schema::dropIfExists('siniestros');
    }
}
