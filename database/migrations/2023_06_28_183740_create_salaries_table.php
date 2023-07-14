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
        Schema::create('salaries', function (Blueprint $table) {//Base salarial
            $table->id()->comment('Identificador único para cada registro de salario');
            $table->foreignId('employee_id')->constrained()->comment('Identificador único del empleado asociado con este registro de salario (clave foránea a la tabla "employees")');
            $table->string('frequency')->comment('La frecuencia con la que se otorga el salario (por ejemplo, mensual, quincenal, semanal, diario, por horas, etc.)');
            // $table->foreignId('currency_id')->comment('La moneda en la que se pagó el salario');
            // $table->date('date')->comment('La fecha en que se efectuó el registro de salario');
            $table->decimal('amount', 10, 2)->comment('La cantidad del salario');
            // $table->string('payment_status')->comment('El estado del pago del salario (pagado, pendiente, cancelado, etc.)');
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
        Schema::dropIfExists('salaries');
    }
};
