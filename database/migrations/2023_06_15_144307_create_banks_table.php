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
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id')->comment('Institución');
            $table->string('name')->comment('Nombre completo');
            $table->string('acronym')->nullable()->comment('Acrónimo');
            $table->string('branch')->nullable()->comment('Sucursal, si es aplicable');
            $table->string('account_number')->nullable()->comment('Número de cuenta');
            $table->string('account_type')->nullable()->comment('Tipo de cuenta bancaria');
            $table->string('routing_number')->nullable()->comment('Número de tránsitoo');
            $table->string('swift_code')->nullable()->comment('SWIFT');
            $table->string('iban')->nullable()->comment('International Bank Account Number');
            $table->string('contact_person')->nullable()->comment('Persona de Contacto');
            $table->string('phone_number')->nullable()->comment('Teléfono');
            $table->string('email')->nullable()->comment('la dirección de correo electrónico');
            $table->string('address')->nullable()->comment('la dirección física');
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
        Schema::dropIfExists('banks');
    }
};

/*
- id: un identificador único para cada banco
- institution_id: el identificador único de la institución asociada a este banco (clave foránea a la tabla "institutions")
- name: el nombre completo
- acronym: el acrónimo o sigla, si lo tiene
- branch: la sucursal, si es aplicable
- account_number: el número de cuenta bancaria de la institución en este banco
- account_type: el tipo de cuenta bancaria de la institución (por ejemplo, cuenta corriente, cuenta de ahorros, etc.)
- routing_number: el número de ruta bancaria (también conocido como número de tránsito) que identifica al banco
- swift_code: el código SWIFT (Society for Worldwide Interbank Financial Telecommunication), si es aplicable
- iban: el número IBAN (International Bank Account Number) de la cuenta bancaria de la institución en este banco, si es aplicable
- contact_person: el nombre
- phone_number: el número de teléfono
- email: la dirección de correo electrónico
- address: la dirección física
- created_at: la fecha y hora de creación del registro en la base de datos- updated_at: la fecha y hora de la última actualización del registro en la base de datos
*/
