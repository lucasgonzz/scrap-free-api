<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAseguradoAseguradoraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asegurado_aseguradora', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asegurado_id')->constrained()->nullable();
            $table->foreignId('aseguradora_id')->constrained()->nullable();
            $table->string('numero_asegurado')->nullable();
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
        Schema::dropIfExists('asegurado_aseguradora');
    }
}
