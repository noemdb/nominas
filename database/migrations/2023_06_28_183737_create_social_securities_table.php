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
        Schema::create('social_securities', function (Blueprint $table) {
            $table->id()->comment('Identificador único para cada registro de información del seguro social');
            $table->foreignId('employee_id')->comment('Identificador único del empleado asociado con esta información del seguro social (clave foránea a la tabla "employees")');
            $table->string('number')->comment('El número de seguro social del empleado');
            $table->string('card_number')->nullable()->comment('El número de la tarjeta de seguro social del empleado, si es aplicable');
            $table->date('card_issue_date')->nullable()->comment('La fecha de emisión de la tarjeta de seguridad social del empleado, si es aplicable');
            $table->date('card_expiration_date')->nullable()->comment('La fecha de caducidad de la tarjetade seguridad social del empleado, si es aplicable');
            $table->boolean('benefits_eligibility')->nullable()->comment('La elegibilidad del empleado para los beneficios del seguro social');
            $table->decimal('benefits_payment_amount', 10, 2)->nullable()->comment('La cantidad de beneficios del seguro social pagados al empleado, si es aplicable');
            $table->date('benefits_payment_start_date')->nullable()->comment('La fecha de inicio de los pagos de beneficios del seguro social al empleado, si es aplicable');
            $table->date('benefits_payment_end_date')->nullable()->comment('La fecha de finalización de los pagos de beneficios del seguro social al empleado, si es aplicable');
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
        Schema::dropIfExists('social_securities');
    }
};
