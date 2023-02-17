<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHonorarioLiquidacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('honorario_liquidacions', function (Blueprint $table) {
            $table->id();
            $table->integer('num');
            $table->foreignId('aseguradora_id')->nullable()->constrained();
            $table->timestamp('fecha_efectiva_honorarios_gestion')->nullable();
            $table->decimal('honorarios_gestion', 14,2)->nullable();
            $table->text('notas')->nullable();
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
        Schema::dropIfExists('honorario_liquidacions');
    }
}
