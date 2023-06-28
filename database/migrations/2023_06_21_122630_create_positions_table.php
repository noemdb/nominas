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
        Schema::create('positions', function (Blueprint $table) {
            $table->id()->comment('Identificador único para cada posición');
            $table->foreignId('employee_id')->comment('Empleado');
            $table->foreignId('area_id')->comment('Área")');
            $table->foreignId('rol_id')->comment('Rol');
            $table->string('name')->comment('Nombre');
            $table->text('description')->nullable()->comment('Descripción');
            $table->date('start')->comment('Fecha de inicio');
            $table->date('end')->nullable()->comment('Fecha de finalización');
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
        Schema::dropIfExists('positions');
    }
};
