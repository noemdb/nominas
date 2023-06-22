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
        Schema::create('employees', function (Blueprint $table) {
            $table->id()->comment('Identificador único para cada empleado');
            $table->foreignId('institution_id')->comment('Institución');
            $table->string('name')->comment('Nombre completo');
            $table->string('ci')->comment('N.Identificación');
            $table->date('hire_date')->comment('Fecha de contratación');
            $table->date('termination_date')->nullable()->comment('Fecha de finalalización');
            $table->enum('status', ['active', 'inactive', 'on leave'])->default('active')->comment('Estado actual');
            $table->string('email')->nullable()->comment('Dirección de correo electrónico');
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
        Schema::dropIfExists('employees');
    }
};
