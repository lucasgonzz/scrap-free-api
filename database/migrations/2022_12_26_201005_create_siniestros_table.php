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
            $table->integer('num');
            $table->integer('asegurado_id')->nullable();
            $table->integer('aseguradora_id')->nullable();
            $table->integer('causa_siniestro_id')->nullable();
            $table->integer('estado_general_siniestro_id')->nullable();
            $table->integer('estado_siniestro_id')->nullable();
            $table->integer('dias_en_estado_siniestro')->nullable();
            $table->integer('localidad_id')->nullable();
            $table->integer('provincia_id')->nullable();
            $table->integer('tipo_orden_de_servicio_id')->nullable();
            $table->integer('gestor_scrap_free_id')->nullable();
            $table->integer('gestor_aseguradora_id')->nullable();
            $table->string('codigo_postal')->nullable();
            $table->text('comentarios_seguro')->nullable();
            $table->decimal('costo_reporte', 14,2)->nullable();
            $table->string('denunciante')->nullable();
            $table->text('foto_deposito_deducible')->nullable();
            $table->text('domicilio_completo_google')->nullable();
            $table->text('domicilio_completo_google_lat')->nullable();
            $table->text('domicilio_completo_google_lng')->nullable();
            $table->text('domicilio_completo_google_place_id')->nullable();
            $table->text('descripcion_bien')->nullable();
            $table->text('entre_calles')->nullable();
            $table->timestamp('fecha_alta_scrap_free')->nullable();
            $table->timestamp('fecha_cierre_administrativo')->nullable();
            $table->timestamp('fecha_cierre_aseguradora')->nullable();
            $table->timestamp('fecha_cierre_scrap_free')->nullable();
            $table->timestamp('fecha_denuncia')->nullable();
            $table->timestamp('fecha_ocurrencia')->nullable();
            $table->decimal('liquidacion_deducible', 14,2)->nullable();
            $table->decimal('liquidacion_siniestro', 14,2)->nullable();
            // $table->text('log_auditoria')->nullable();
            $table->text('notas_domicilio')->nullable();
            $table->text('notas_importantes')->nullable();
            $table->integer('orden_servicio')->nullable();
            $table->text('recomendacion')->nullable();
            $table->decimal('reparacion_deducible', 14,2)->nullable();
            $table->decimal('reparacion_paga_asegurado', 14,2)->nullable();
            $table->decimal('reparacion_siniestro', 14,2)->nullable();
            $table->string('numero_siniestro')->nullable();
            $table->integer('centro_reparacion_id')->nullable();
            // $table->foreignId('centro_reparacion_id')->nullable()->constrained();
            $table->text('descripcion_del_hecho')->nullable();
            $table->integer('poliza_id')->nullable();
            // $table->foreignId('poliza_id')->nullable()->constrained();
            $table->integer('tipo_producto_de_seguro_id')->nullable();
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
        Schema::dropIfExists('siniestros');
    }
}
