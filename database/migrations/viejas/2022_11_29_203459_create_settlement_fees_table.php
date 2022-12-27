<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettlementFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settlement_fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('insurer_id')->constrained();
            $table->timestamp('fecha_efectiva_honorarios')->nullable();
            $table->decimal('honorarios_gestion', 14,2)->nullable();
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
        Schema::dropIfExists('settlement_fees');
    }
}
