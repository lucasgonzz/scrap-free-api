<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoveragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coverages', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->foreignId('insurer_id')->nullable()->constrained();
            $table->decimal('deducible', 12,2)->nullable();
            $table->decimal('deducible_en_pesos', 12,2)->nullable();
            $table->decimal('monto_minimo', 12,2)->nullable();
            $table->decimal('suma_asegurada', 12,2)->nullable();
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
        Schema::dropIfExists('coverages');
    }
}
