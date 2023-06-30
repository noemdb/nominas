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
        Schema::create('approveds', function (Blueprint $table) {
            $table->id()->comment('Identificador');
            $table->string('type')->comment('Tipo (Anuales, Colectivas)');
            $table->foreignId('employee_id')->nullable()->comment('Empleado');
            $table->foreignId('request_id')->nullable()->comment('Empleado');
            $table->foreignId('formulation_id')->nullable()->comment('Fórmula');
            $table->string('description')->nullable()->comment('Descripción');
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
        Schema::dropIfExists('approveds');
    }
};
