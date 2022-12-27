<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biens', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->foreignId('causa_bien_id')->constrained()->nullable();
            $table->foreignId('estado_bien_id')->constrained()->nullable();
            $table->foreignId('linea_id')->constrained()->nullable();
            $table->foreignId('sub_linea_id')->constrained()->nullable();
            $table->foreignId('tecnico_asegurado_id')->constrained('tecnicos')->nullable();
            $table->foreignId('tecnico_scrap_free_id')->constrained('tecnicos')->nullable();
            $table->foreignId('logistica_id')->constrained()->nullable();
            $table->foreignId('siniestro_id')->constrained()->nullable();

            $table->text('accesorios')->nullable();
            $table->boolean('tiene_base')->nullable();
            $table->boolean('tiene_cable')->nullable();
            $table->boolean('tiene_cargador')->nullable();
            $table->boolean('tiene_control')->nullable();
            $table->text('comentarios_tecnico')->nullable();
            $table->text('descripcion')->nullable();

            $table->text('factura_compra_asegurado')->nullable();
            $table->text('factura_tecnico_asegurado')->nullable();
            $table->text('factura_tecnico_scrap_free')->nullable();
            $table->timestamp('fecha_compra')->nullable();
            $table->text('foto_adicional_asegurado')->nullable();
            $table->text('foto_atras_asegurado')->nullable();
            $table->text('foto_atras_tecnico_scrap_free')->nullable();
            $table->text('foto_evidencia_scrap_free')->nullable();
            $table->text('foto_frente_asegurado')->nullable();
            $table->text('foto_frente_tecnico_scrap_free')->nullable();
            $table->text('informe_tecnico_asegurado')->nullable();
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('numero_serie')->nullable();
            $table->text('notas')->nullable();
            $table->decimal('pagado_tecnico', 14,2)->nullable();
            $table->text('posible_causa_asegurado')->nullable();
            $table->boolean('precisa_embalaje')->nullable();
            $table->decimal('presupuesto_monto_asegurado', 14,2)->nullable();

            $table->decimal('liquidacion_bien', 12,2)->nullable();
            $table->decimal('liquidacion_deducible', 12,2)->nullable();
            $table->decimal('liquidacion_paga_asegurado', 12,2)->nullable();
            $table->decimal('valor_reposicion_a_nuevo', 12,2)->nullable();
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
        Schema::dropIfExists('biens');
    }
}
