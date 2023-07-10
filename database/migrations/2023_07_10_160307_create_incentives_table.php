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
        Schema::create('incentives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->comment('el identificador único del empleado al que se está otorgando el incentivo (clave foránea a la tabla "employees")');
            $table->string('type')->comment('el tipo de incentivo que se está otorgando (por ejemplo, incentivo por cumplimiento de objetivos, incentivo por rendimiento excepcional, incentivo por sugerencia de mejora, etc.)');
            $table->string('description')->nullable()->comment('una breve descripción del tipo de incentivo que se está otorgando');
            $table->decimal('amount', 10, 2)->comment('la cantidad del incentivo otorgado al empleado');
            $table->string('frequency')->comment('la frecuencia con la que se otorga el incentivo (por ejemplo, anual, semestral, trimestral, mensual, etc.)');
            $table->date('date')->comment('la fecha en la que se otorga el incentivo');
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
        Schema::dropIfExists('incentives');
    }
};

/*
- id: un identificador único para cada registro de incentivo
- employee_id: el identificador único del empleado al que se está otorgando el incentivo (clave foránea a la tabla "employees")
- type: el tipo de incentivo que se está otorgando (por ejemplo, incentivo por cumplimiento de objetivos, incentivo por rendimiento excepcional, incentivo por sugerencia de mejora, etc.)
- description: una breve descripción del tipo de incentivo que se está otorgando
- amount: la cantidad del incentivo otorgado al empleado
- frequency: la frecuencia con la que se otorga el incentivo (por ejemplo, anual, semestral, trimestral, mensual, etc.)
- date: la fecha en la que se otorga el incentivo
- created_at: la fecha y hora de creación del registro en la base de datos
- updated_at: la fecha y hora de la última actualización del registro en la base de datos
*/
