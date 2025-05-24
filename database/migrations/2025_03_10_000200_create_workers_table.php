<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // Relación con users
            $table->string('first_name'); // Nombre
            $table->string('last_name');  // Apellido
            $table->string('identification')->unique(); // Cédula / Pasaporte
            $table->string('email')->unique()->nullable(); // Correo institucional
            $table->string('phone')->nullable(); // Teléfono
            $table->date('birth_date')->nullable(); // Fecha de nacimiento
            $table->string('gender')->nullable(); // Género
            $table->string('marital_status')->nullable(); // Estado civil
            $table->string('nationality')->nullable(); // Nacionalidad
            $table->date('hire_date'); // Fecha de ingreso
            $table->decimal('base_salary', 10, 2)->default(0.00); // Salario base
            $table->string('contract_type'); // Tipo de contrato
            $table->string('payment_method'); // Método de pago
            $table->string('bank_name')->nullable(); // Nombre del banco
            $table->string('bank_account_number')->nullable(); // Número de cuenta bancaria
            $table->string('tax_identification_number')->nullable(); // RIF o equivalente
            $table->string('social_security_number')->nullable(); // Número de seguro social
            $table->string('pension_fund')->nullable(); // Fondo de pensiones (si aplica)
            $table->boolean('is_active')->nullable()->default(true); // Estado del trabajador (Activo/Inactivo)
            $table->timestamps();

            // Índices para optimizar búsquedas y ordenamiento
            $table->index(['first_name', 'last_name']);
            $table->index('identification');
            $table->index('email');
            $table->index('is_active');
            $table->index('hire_date');
            $table->index('base_salary');
        });

        // Agregar índices FULLTEXT después de crear la tabla
        DB::statement('ALTER TABLE workers ADD FULLTEXT INDEX workers_search_index (first_name, last_name, identification, email)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workers');
    }
};