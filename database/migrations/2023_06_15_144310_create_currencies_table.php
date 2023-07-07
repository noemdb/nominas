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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id')->comment('Institución');
            $table->string('name')->comment('Nombre');
            $table->string('symbol')->comment('Símbolo');
            $table->string('lg')->nullable()->comment('Símbolo Grande');
            $table->string('md')->nullable()->comment('Símbolo Medio');
            $table->string('sm')->nullable()->comment('Símbolo Corto');
            $table->string('observations')->nullable()->comment('Observaciones');
            $table->boolean('status_referential')->nullable()->default(false)->comment('Moneda Referencial');
            $table->boolean('status_cripto')->nullable()->default(false)->comment('Cripto Moneda');
            $table->boolean('status_forgering')->nullable()->default(false)->comment('Moneda extranjera');
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
        Schema::dropIfExists('currencies');
    }
};
