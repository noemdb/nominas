<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchange_rates', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('currency_id')->unsigned()->comment('Moneda');
            $table->foreignId('currency_referential_id')->unsigned()->comment('Moneda Referencial');
            $table->date('date')->comment('Fecha de la tasa de cambio');
            $table->float('ammount',20,2)->comment('Monto de la tasa de cambio');
            $table->string('source')->comment('Fuente de Información');
            $table->string('observations')->nullable()->comment('Observaciones');
            $table->boolean('status_official')->default(true)->comment('Fuente Oficial');
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
        Schema::dropIfExists('exchange_rates');
    }
};
