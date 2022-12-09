<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechnicalReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technical_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained();
            $table->foreignId('probable_cause_id')->constrained();
            $table->foreignId('sinister_id')->constrained();
            $table->foreignId('technical_id')->constrained();
            $table->text('descripcion_revision')->nullable();
            $table->text('foto_adicional')->nullable();
            $table->text('foto_atras')->nullable();
            $table->text('foto_frente')->nullable();
            $table->decimal('pagado_it',14,2)->nullable();
            $table->decimal('pagado_reparacion',14,2)->nullable();
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
        Schema::dropIfExists('technical_reports');
    }
}
