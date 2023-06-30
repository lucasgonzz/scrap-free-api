<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColorSiniestrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('color_siniestros', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('estado_siniestro_id');
            $table->integer('dias_estado_siniestro_min')->nullable();
            $table->integer('dias_estado_siniestro_max')->nullable();
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
        Schema::dropIfExists('color_siniestros');
    }
}
