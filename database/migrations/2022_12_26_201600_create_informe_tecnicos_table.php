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
            $table->foreignId('bien_id')->constrained()->nullable();
            $table->foreignId('causa_probable_id')->constrained()->nullable();
            $table->foreignId('siniestro_id')->constrained()->nullable();
            $table->foreignId('tecnico_id')->constrained()->nullable();
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
