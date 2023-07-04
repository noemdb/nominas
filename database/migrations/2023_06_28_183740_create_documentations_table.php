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
        Schema::create('documentations', function (Blueprint $table) {
            $table->id()->comment('Identificador único para cada registro de documentación');
            $table->foreignId('employee_id')->constrained()->comment('Identificador único del empleado asociado con esta documentación (clave foránea a la tabla "employees")');
            $table->text('description')->nullable()->comment('Una breve descripción del curso o programa de formación y capacitación');
            $table->string('type')->comment('El tipo de documento');
            $table->string('number')->comment('El número de documento');
            $table->date('expiration_date')->nullable()->comment('La fecha de caducidad del documento, si es aplicable');
            $table->date('issue_date')->nullable()->comment('La fecha de emisión del documento, si es aplicable');
            $table->string('country')->nullable()->comment('El país que emitió el documento, si es aplicable');
            $table->text('file')->nullable()->comment('Archivo adjjunto');
            $table->text('comments')->nullable()->comment('Cualquier comentario adicional sobre la documentación');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documentations');
    }
};
