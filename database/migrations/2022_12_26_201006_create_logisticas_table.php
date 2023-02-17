<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogisticasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logisticas', function (Blueprint $table) {
            $table->id();
            $table->integer('num');
            $table->foreignId('siniestro_id')->constrained('siniestros');
            $table->foreignId('transportista_devolucion_id')->nullable()->constrained('transportistas');
            $table->foreignId('transportista_retiro_id')->nullable()->constrained('transportistas');
            $table->decimal('costo_flete_devolucion', 14,2)->nullable();
            $table->decimal('costo_flete_ida', 14,2)->nullable();
            $table->timestamp('fecha_cobro_flete_ida')->nullable();
            $table->text('domicilio_devolucion')->nullable();
            $table->text('domicilio_retiro')->nullable();
            $table->timestamp('fecha_entrega_asegurado')->nullable();
            $table->timestamp('fecha_entrega_scrap_free')->nullable();
            $table->timestamp('fecha_estimada_entrega_asegurado')->nullable();
            $table->timestamp('fecha_estimada_entrega_scrap_free')->nullable();
            $table->timestamp('fecha_estimada_retiro_asegurado')->nullable();
            $table->timestamp('fecha_estimada_retiro_scrap_free')->nullable();
            $table->timestamp('fecha_pedido_retiro_asegurado')->nullable();
            $table->timestamp('fecha_pedido_retiro_scrap_free')->nullable();
            $table->timestamp('fecha_retiro_asegurado')->nullable();
            $table->timestamp('fecha_retiro_scrap_free')->nullable();
            $table->decimal('flete_otros_costos', 14,2)->nullable();
            $table->text('notas_transportista_devolucion')->nullable();
            $table->text('notas_transportista_retiro')->nullable();
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
        Schema::dropIfExists('logisticas');
    }
}
