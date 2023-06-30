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
        Schema::create('previous_works', function (Blueprint $table) {
            $table->id()->comment('Identificador');
            $table->foreignId('employee_id')->comment('Clave foránea que hace referencia al ID del empleado correspondiente en la tabla de empleados');
            $table->string('company_name')->comment('Nombre del empleador anterior');
            $table->string('position')->comment('Cargo que ocupó el empleado en su trabajo anterior');
            $table->date('start_date')->comment('Fecha de inicio del trabajo anterior');
            $table->date('end_date')->comment('Fecha de finalización del trabajo anterior');
            $table->string('reason_for_leaving')->comment('Razón por la que el empleado dejó su trabajo anterior');
            $table->string('references')->nullable()->comment('Información de contacto de posibles referencias para el empleado');
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
        Schema::dropIfExists('previous_works');
    }
};
