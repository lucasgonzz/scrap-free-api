<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsurersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurers', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('domicilio')->nullable();
            $table->string('contacto')->nullable();
            $table->string('nombre_contacto')->nullable();
            $table->text('notas')->nullable();

            // Estas de abajo no las pusiste en el utlimo excel
            // $table->timestamp('fecha_efectiva_honorarios_gestion')->nullable();
            // $table->decimal('honorarios_gestion', 14,2)->nullable();
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
        Schema::dropIfExists('insurers');
    }
}
