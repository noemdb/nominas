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
        Schema::create('trainings', function (Blueprint $table) {
            $table->id()->comment('Identificador único para cada registro de formación y capacitación');
            $table->foreignId('employee_id')->constrained()->comment('Identificador único del empleado asociado con este registro de formación y capacitación (clave foránea a la tabla "employees")');
            $table->string('name')->comment('El nombre del curso o programa de formación y capacitación');
            $table->text('description')->nullable()->comment('Una breve descripción del curso o programa de formación y capacitación');
            $table->string('provider')->nullable()->comment('El proveedor del curso o programa de formación y capacitación');
            $table->date('start')->nullable()->comment('La fecha de inicio del curso o programa de formación y capacitación');
            $table->date('end')->nullable()->comment('La fecha de finalización del curso o programa de formación y capacitación');
            $table->string('location')->nullable()->comment('La ubicación del curso o programa de formación y capacitación');
            $table->integer('duration_hours')->nullable()->comment('La duración del curso o programa de formación y capacitación en horas');
            $table->string('certificate_number')->nullable()->comment('El número de certificado obtenido por el empleado al completar el curso o programa de formación y capacitación, si es aplicable');
            $table->date('certificate_issue')->nullable()->comment('La fecha de emisión del certificado obtenido por el empleado al completar el curso o programa de formación y capacitación, si es aplicable');
            $table->date('certificate_expiration')->nullable()->comment('La fecha de caducidad del certificado obtenido por el empleado al completar el curso o programa de formación y capacitación, si es aplicable');
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
        Schema::dropIfExists('trainings');
    }
};
