<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoberturaPolizaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cobertura_poliza', function (Blueprint $table) {
            $table->id();
            $table->integer('cobertura_id');
            $table->integer('poliza_id');
            $table->decimal('cobertura', 14,2)->nullable();
            $table->decimal('deducible', 14,2)->nullable();
            $table->decimal('deducible_en_pesos', 14,2)->nullable();
            $table->decimal('monto_minimo', 14,2)->nullable();
            $table->decimal('suma_asegurada', 14,2)->nullable();
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
        Schema::dropIfExists('cobertura_poliza');
    }
}
