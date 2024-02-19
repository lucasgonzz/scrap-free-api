<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoberturaLiquidacionAdministrativaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cobertura_liquidacion_administrativa', function (Blueprint $table) {
            $table->id();
            $table->integer('cobertura_id');
            $table->integer('liquidacion_administrativa_id');
            $table->decimal('suma_asegurada', 18,2)->nullable();
            $table->decimal('perdidas', 18,2)->nullable();
            $table->decimal('deducible', 18,2)->nullable();
            $table->decimal('indemnizacion', 18,2)->nullable();
            // $table->decimal('indemnizacion_reparacion', 18,2)->nullable();
            // $table->decimal('indemnizacion_a_nuevo', 18,2)->nullable();
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
        Schema::dropIfExists('cobertura_liquidacion_administrativa');
    }
}
