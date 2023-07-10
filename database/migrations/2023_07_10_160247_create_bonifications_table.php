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
        Schema::create('bonifications', function (Blueprint $table) {
            $table->id()->comment('Identificador único para cada registro de bonificación');
            $table->foreignId('employee_id')->comment('El identificador único del empleado al que se está otorgando la bonificación (clave foránea a la tabla \'employees\')');
            $table->string('type')->comment('El tipo de bonificación que se está otorgando (por ejemplo, bonificación por desempeño, bonificación por objetivo alcanzado, bonificación por antigüedad, etc.)');
            $table->string('description')->nullable()->comment('Una breve descripción del tipo de bonificación que se está otorgando');
            $table->decimal('amount', 10, 2)->comment('La cantidad de la bonificación otorgada al empleado');
            $table->string('frequency')->comment('La frecuencia con la que se otorga la bonificación (por ejemplo, anual, semestral, trimestral, mensual, etc.)');
            $table->date('date')->comment('La fecha en que se otorga la bonificación');
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
        Schema::dropIfExists('bonifications');
    }
};
