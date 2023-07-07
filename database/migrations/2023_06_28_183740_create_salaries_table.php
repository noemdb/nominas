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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id()->comment('Identificador único para cada registro de salario');
            $table->foreignId('employee_id')->constrained()->comment('Identificador único del empleado asociado con este registro de salario (clave foránea a la tabla "employees")');
            $table->date('salary_date')->comment('La fecha en que se efectuó el registro de salario');
            $table->decimal('amount', 10, 2)->comment('La cantidad del salario');
            $table->string('currency')->comment('La moneda en la que se pagó el salario');
            $table->string('payment_method')->comment('El método de pago utilizado para el salario (por ejemplo, transferencia bancaria, cheque, etc.)');
            $table->string('payment_status')->comment('El estado del pago del salario (pagado, pendiente, cancelado, etc.)');
            $table->decimal('tax_rate', 5, 2)->nullable()->comment('La tasa de impuesto sobre la renta aplicada al salario');
            $table->decimal('tax_amount', 10, 2)->nullable()->comment('El monto del impuesto sobre la renta deducido del salario');
            $table->string('social_security_number')->nullable()->comment('El número de seguro social del empleado, si es aplicable');
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
