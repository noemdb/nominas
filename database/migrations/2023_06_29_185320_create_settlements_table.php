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
        Schema::create('settlements', function (Blueprint $table) {
            $table->id()->comment('Identificador único para cada registro de nómina');
            $table->foreignId('employee_id')->comment('El identificador único del empleado asociado con esta nómina (clave foránea a la tabla "employees")');
            $table->date('date')->comment('La fecha de la nómina');
            $table->decimal('gross_salary', 10, 2)->comment('El salario bruto del empleado');
            $table->decimal('net_salary', 10, 2)->comment('El salario neto del empleado');
            $table->decimal('tax_deductions', 10, 2)->nullable()->comment('Las deducciones fiscales de la nómina');
            $table->decimal('other_deductions', 10, 2)->nullable()->comment('Otras deducciones de la nómina');
            $table->decimal('total_deductions', 10, 2)->nullable()->comment('El total de deducciones de la nómina');
            $table->decimal('total_additions', 10, 2)->nullable()->comment('El total de adiciones a la nómina');
            $table->decimal('total_pay', 10, 2)->comment('El total de la nómina');
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
        Schema::dropIfExists('settlements');
    }
};
