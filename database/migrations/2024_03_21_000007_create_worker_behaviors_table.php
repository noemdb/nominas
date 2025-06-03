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
        Schema::create('worker_behaviors', function (Blueprint $table) {
            $table->id(); // ID único del registro de comportamiento
            $table->foreignId('worker_id')->constrained()->onDelete('cascade')->comment('ID del trabajador');
            $table->date('date')->comment('Fecha de la evaluación o registro');
            $table->integer('attendance_days')->default(0)->comment('Días de asistencia en la quincena');
            $table->integer('absences')->default(0)->comment('Días de inasistencia sin justificación');
            $table->integer('permissions')->default(0)->comment('Días de permiso con autorización');
            $table->integer('delays')->default(0)->comment('Cantidad de retardos');
            $table->decimal('labor_hours', 6, 2)->default(0)->comment('Horas laboradas en el período');
            $table->decimal('administrative_hours', 6, 2)->default(0)->comment('Horas administrativas o de oficina');
            $table->integer('medical_rest_days')->default(0)->comment('Días de descanso médico');
            $table->decimal('medical_rest_hours', 6, 2)->default(0)->comment('Horas de descanso médico');
            $table->integer('paid_permission_days')->default(0)->comment('Días de permiso con goce de sueldo');
            $table->decimal('paid_permission_hours', 6, 2)->default(0)->comment('Horas de permiso con goce de sueldo');
            $table->integer('unpaid_permission_days')->default(0)->comment('Días de permiso sin goce de sueldo');
            $table->decimal('unpaid_permission_hours', 6, 2)->default(0)->comment('Horas de permiso sin goce de sueldo');
            $table->integer('unjustified_absence_days')->default(0)->comment('Días de inasistencia injustificada');
            $table->decimal('unjustified_absence_hours', 6, 2)->default(0)->comment('Horas de inasistencia injustificada');
            $table->text('observations')->nullable()->comment('Observaciones adicionales sobre el comportamiento');
            $table->decimal('bonus', 10, 2)->default(0)->comment('Bonificación por buen comportamiento');
            $table->decimal('discount', 10, 2)->default(0)->comment('Descuento por faltas o retardos');
            $table->string('status')->default('pending')->comment('Estado del registro: pendiente, aprobado, rechazado');
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete()->comment('ID del usuario que aprueba');
            $table->timestamp('approved_at')->nullable()->comment('Fecha y hora de aprobación');
            $table->timestamps(); // Timestamps de creación y actualización
            $table->softDeletes()->comment('Borrado lógico');

            // Índices para mejorar el rendimiento de las consultas
            $table->index(['worker_id', 'date']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('worker_behaviors');
    }
};
