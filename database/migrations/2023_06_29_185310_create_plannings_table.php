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
        Schema::create('plannings', function (Blueprint $table) {
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
        Schema::dropIfExists('plannings');
    }
};

/*
- id: un identificador único para cada registro de planificación de vacaciones
- employee_id: el identificador único del empleado para el que se está haciendo la planificación de vacaciones (clave foránea a la tabla 'employees')
- vacation_year: el año fiscal en el que se está haciendo la planificación de vacaciones
- vacation_entitlement: el número de días de vacaciones a los que tiene derecho el empleado para el año fiscal actual
- vacation_used: el número de días de vacaciones utilizados por el empleado en el año fiscal actual
- vacation_available: el número de días de vacaciones disponibles para el empleado en el año fiscal actual
- vacation_notes: cualquier nota adicional sobre la planificación de vacaciones
- created_at: la fecha y hora de creación del registro en la base de datos
- updated_at: la fecha y hora de la última actualización del registro en la base de datos

*/
