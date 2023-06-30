<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutions', function (Blueprint $table) {
            $table->id()->comment('Identificador único para cada institución');
            $table->string('name')->comment('Nombre completo de la institución');
            $table->string('type')->comment('Tipo de la institución');
            $table->string('acronym')->nullable()->comment('Acrónimo o sigla de la institución, si lo tiene');
            $table->string('address')->comment('Dirección física de la institución');
            $table->string('phone_number')->comment('Número de teléfono de la institución');
            $table->string('email')->comment('Dirección de correo electrónico de la institución');
            $table->string('website')->nullable()->comment('Dirección del sitio web de la institución, si lo tiene');
            $table->date('foundation_date')->nullable()->comment('Fecha de fundación de la institución, si se conoce');
            $table->boolean('legal_status')->comment('Estado legal de la institución (por ejemplo, empresa, organización sin fines de lucro, etc.)');
            $table->string('tax_id')->nullable()->comment('Número de identificación fiscal de la institución, si se conoce');
            $table->string('registration_number')->nullable()->comment('Número de registro de la institución, si se conoce');

            $table->decimal('accrual_rate', 10, 2)->nullable()->comment('La tasa a la que se acumulan los días de vacaciones para el empleado'); //(por ejemplo, un número fijo de días por mes, un porcentaje del tiempo trabajado, etc.)
            $table->integer('maximum_days')->nullable()->comment('El número máximo de días de vacaciones que puede acumular el empleado');
            $table->date('use_period_start_date')->nullable()->comment('La fecha en que comienza el período en que el empleado puede usar los días de vacaciones acumulados');
            $table->date('use_period_end_date')->nullable()->comment('La fecha en que finaliza el período en que el empleado puede usar los días de vacaciones acumulados');
            $table->boolean('carryover_allowed')->default(false)->comment('Un indicador de si se permite que el empleado lleve días de vacaciones no utilizados de un período a otro');
            $table->integer('carryover_maximum_days')->nullable()->comment('El número máximo de días de vacaciones que el empleado puede llevar de un período a otro, si se permite el carryover');
            $table->boolean('payout_allowed')->default(false)->comment('Un indicador de si se permite que el empleado reciba un pago en efectivo por días de vacaciones no utilizados al final del año fiscal o al final del empleo');
            $table->text('payout_formulation_id')->nullable()->comment('La fórmula utilizada para calcular el valor del pago en efectivo por días de vacaciones no utilizados, si se permite el pago');

            $table->string('logo')->nullable()->comment('Imagen del logo de la institución, almacenada como un archivo en la base de datos o en un servidor de archivos externo');
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
        Schema::dropIfExists('institutions');
    }
}
