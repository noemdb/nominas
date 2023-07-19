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
        Schema::create('deductions', function (Blueprint $table) {
            $table->id()->comment('Identificador único para cada registro de deducción');
            $table->foreignId('institution_id')->comment('Institución');
            $table->foreignId('employee_id')->nullable()->comment('El identificador único del empleado al que se está aplicando la deducción (clave foránea a la tabla \'employees\')');
            $table->string('type')->comment('El tipo de deducción que se está aplicando (por ejemplo, impuestos, contribuciones a planes de jubilación, seguros, préstamos, etc.)');
            $table->string('description')->nullable()->comment('Una breve descripción del tipo de deducción que se está aplicando');
            $table->string('formulation_id')->nullable()->comment('La fórmula utilizada para calcular la cantidad dela deducción (por ejemplo, un porcentaje del salario del empleado, un monto fijo, etc.)');
            $table->decimal('amount', 10, 2)->nullable()->comment('El monto máximo de la deducción que se puede aplicar en un período de pago, si es aplicable');
            $table->decimal('percentage', 10, 2)->nullable()->comment('El porcentaje de la deducción que se aplica en cada período de pago, si corresponde');
            $table->decimal('cap', 10, 2)->nullable()->comment('El límite máximo de la deducción en relación al ingreso del empleado, si es aplicable');
            $table->boolean('taxable')->default(true)->comment('Un indicador de si la deducción es imponible para fines fiscales, lo que significa que se considera como ingreso sujeto a impuestos');
            $table->boolean('mandatory')->default(true)->comment('Un indicador de si la deducción es obligatoria para todos los empleados');
            $table->boolean('post_tax')->default(false)->comment('Un indicador de si la deducción se aplica después de impuestos');
            $table->boolean('tax_exempt')->default(false)->comment('Un indicador de si la deducción está exenta de impuestos');
            $table->decimal('employer_contribution', 10, 2)->nullable()->comment('La contribución del empleador a la deducción, si corresponde');
            $table->decimal('employee_contribution', 10, 2)->nullable()->comment('La contribución del empleado a la deducción, si corresponde');
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
        Schema::dropIfExists('deductions');
    }
};


/*

Obligatorias:
-. Seguridad Social: Aporte obligatorio del trabajador al Instituto Venezolano de los Seguros Sociales (IVSS), el cual se calcula en función de un porcentaje del salario devengado.
-. Fondo de Ahorro Obligatorio para la Vivienda (FAOV): Aporte obligatorio del trabajador para el financiamiento de programas de vivienda, el cual se calcula en función de un porcentaje del salario devengado.
-. Impuesto Sobre la Renta (ISLR): Deducción obligatoria del impuesto sobre la renta, que se calcula en función del salario anual del trabajador.
-. Fondo Nacional de Ahorro (FNA): Aporte obligatorio del trabajador para el financiamiento de programas de ahorro y crédito, el cual se calcula en función de un porcentaje del salario devengado.
-. Ley de Política Habitacional: Aporte obligatorio del trabajador para el financiamiento de programas de vivienda, el cual se calcula en función de un porcentaje del salario devengado.

Voluntarias/Opcionales
-. Caja de Ahorro: Deducción voluntaria del salario del trabajador destinada a un fondo de ahorro para gastos personales, emergencias o cualquier otra finalidad.
-. Descuentos por préstamos: Deducción voluntaria del salario del trabajador para el pago de préstamos solicitados a la empresa o a terceros.
-. Descuentos por adelantos: Deducción voluntaria del salario del trabajador para el pago de adelantos de sueldo otorgados por la empresa.
-. Planes de salud: Deducción voluntaria del salario del trabajador para el pago de un plan de salud privado.
-. Seguros de vida: Deducción voluntaria del salario del trabajador para el pago de una póliza de seguro de vida.
*/
