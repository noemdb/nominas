<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->enum('contract_type', ['Fijo', 'Temporal', 'Contratado']); // Tipo de contrato
            $table->enum('payment_method', ['Transferencia', 'Cheque', 'Efectivo'])->default('Transferencia'); // Método de pago
            $table->string('bank_name')->nullable(); // Nombre del banco
            $table->string('bank_account_number')->nullable(); // Número de cuenta bancaria
            $table->string('tax_identification_number')->nullable(); // RIF o equivalente
            $table->string('social_security_number')->nullable(); // Número de seguro social
            $table->string('pension_fund')->nullable(); // Fondo de pensiones (si aplica)
            $table->boolean('is_active')->default(true); // Estado del trabajador (Activo/Inactivo)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workers');
    }
};
