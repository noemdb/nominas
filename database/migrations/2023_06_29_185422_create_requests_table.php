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
        Schema::create('requests', function (Blueprint $table) {
            $table->id()->comment('Identificador único');
            $table->foreignId('employee_id')->constrained()->comment('Empleado');
            $table->string('description')->nullable()->comment('Descripción');
            $table->integer('days')->nullable()->comment('El número de días de vacaciones');
            $table->date('start')->nullable()->comment('Fecha inicial');
            $table->date('end')->nullable()->comment('Fecha final');
            $table->boolean('payout')->default(false)->comment('Solicitud de pago');
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
        Schema::dropIfExists('requests');
    }
};
