<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBienCoberturaAplicadaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bien_cobertura_aplicada', function (Blueprint $table) {
            $table->id();
            $table->integer('bien_id');
            $table->integer('cobertura_id');

            $table->decimal('remanente_a_cubrir', 18,2)->nullable(); 
            $table->decimal('deducible', 18,2)->nullable();
            $table->decimal('fondos', 18,2)->nullable();
            $table->decimal('deducible_aplicado', 18,2)->nullable();
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
        Schema::dropIfExists('bien_cobertura_aplicada');
    }
}
