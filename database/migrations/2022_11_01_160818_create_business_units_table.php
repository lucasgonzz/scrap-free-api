<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_units', function (Blueprint $table) {
            $table->id();
            $table->text('nombre');
            $table->foreignId('insurer_id')->constrained()->nullable();
            $table->text('email')->nullable();
            $table->text('domicilio')->nullable();
            $table->text('notas')->nullable();
            $table->text('responsable')->nullable();
            $table->text('telefono_conmutador')->nullable();
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
        Schema::dropIfExists('business_units');
    }
}
