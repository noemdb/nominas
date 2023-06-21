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
        Schema::create('personals', function (Blueprint $table) {
            $table->id()->comment('Identificador único para cada registro de información personal');
            $table->foreignId('employee_id')->constrained()->comment('Identificador único asociado con esta información personal (clave foránea a la tabla "employees")');
            $table->string('address')->nullable()->comment('Dirección física');
            $table->string('city')->comment('Ciudad');
            $table->string('state')->comment('Estado o provincia');
            $table->string('zip_code')->comment('Código postal');
            $table->string('country')->comment('País');
            $table->string('phone_number')->nullable()->comment('N.Teléfono');
            $table->string('home_phone')->nullable()->comment('N.Teléfono del hogar');
            $table->string('emergency_contact_name')->nullable()->comment('El nombre de la persona de contacto de emergencia');
            $table->string('emergency_contact_relationship')->nullable()->comment('La relación de la persona de contacto de emergencia con el empleado');
            $table->string('emergency_contact_phone')->nullable()->comment('El número de teléfono de la persona de contacto de emergencia');
            $table->string('emergency_contact_email')->nullable()->comment('La dirección de correo electrónico de la persona de contacto de emergencia');
            $table->text('other_details')->nullable()->comment('Cualquier otra información personal relevante');
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
        Schema::dropIfExists('personals');
    }
};
