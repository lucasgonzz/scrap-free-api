<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformeTecnicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informe_tecnicos', function (Blueprint $table) {
            $table->id();
            $table->integer('bien_id')->nullable();
            $table->integer('causa_probable_id')->nullable();
            $table->integer('siniestro_id')->nullable();
            $table->integer('tecnico_id')->nullable();
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
        Schema::dropIfExists('informe_tecnicos');
    }
}
