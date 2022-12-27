<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAseguradorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aseguradoras', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('direccion')->nullable();
            $table->string('contacto')->nullable();
            $table->string('nombre_contacto')->nullable();
            $table->text('notas')->nullable();
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
        Schema::dropIfExists('aseguradoras');
    }
}
