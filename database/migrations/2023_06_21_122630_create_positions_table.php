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
            $table->string('contract_type')->comment('Tipo de contrato');
            $table->text('description')->nullable()->comment('Descripción');
            $table->date('start')->comment('Fecha de inicio');
            $table->date('end')->nullable()->comment('Fecha de finalización');
            $table->date('start_salary')->comment('Inicio de actividades');
            $table->string('frequency_workday')->nullable()->comment('Frecuencia de la jornada laboral');
            $table->integer('workday')->nullable()->comment('Jornada laboral');
            $table->boolean('status')->default(true)->comment('Activo/Inactivo');
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
