<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBienLiquidacionAdministrativaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bien_liquidacion_administrativa', function (Blueprint $table) {
            $table->id();
            $table->integer('bien_id');
            $table->integer('liquidacion_administrativa_id');
            $table->decimal('anos_antiguedad', 12,2)->nullable();
            $table->decimal('procentage_depreciacion', 12,2)->nullable();
            $table->decimal('valor_depreciado', 12,2)->nullable();
            $table->decimal('indemnizacion_bien', 18,2)->nullable();
            $table->decimal('ratio', 18,2)->nullable();
            $table->decimal('reparacion_con_deducible', 18,2)->nullable();
            $table->decimal('deducible_aplicado', 18,2)->nullable();
            $table->decimal('deducible_aplicado_a_reparacion', 18,2)->nullable();
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
        Schema::dropIfExists('bien_liquidacion_administrativa');
    }
}
