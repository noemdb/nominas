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
        Schema::create('subsidies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->comment('el identificador único del empleado al que se está otorgando el incentivo (clave foránea a la tabla "employees")');
            $table->string('type')->comment('el tipo de incentivo que se está otorgando (por ejemplo, incentivo por cumplimiento de objetivos, incentivo por rendimiento excepcional, incentivo por sugerencia de mejora, etc.)');
            $table->string('description')->nullable()->comment('una breve descripción del tipo de subvención');
            $table->decimal('amount', 10, 2)->comment('la cantidad del incentivo otorgado al empleado');
            $table->foreignId('formulation_id')->nullable()->comment('La fórmula utilizada para calcular la cantidad');
            $table->string('frequency')->comment('la frecuencia con la que se otorga el incentivo (por ejemplo, anual, semestral, trimestral, mensual, etc.)');
            $table->date('date')->comment('la fecha en la que se otorga el incentivo');
            $table->boolean('status')->default(false)->comment('Activo/Desactivo');
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
        Schema::dropIfExists('subsidies');
    }
};
