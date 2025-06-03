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
        Schema::create('payroll_worker_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('payroll_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('ID de la nómina');

            $table->foreignId('worker_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('ID del trabajador');

            $table->foreignId('position_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('ID del cargo del trabajador');

            // Información del período laboral
            $table->integer('worked_days')->default(0)->comment('Días trabajados en la quincena');
            $table->decimal('academic_hours', 6, 2)->default(0)->comment('Horas académicas laboradas');
            $table->decimal('administrative_hours', 6, 2)->default(0)->comment('Horas administrativas laboradas');

            // Días y horas especiales
            $table->integer('medical_rest_days')->default(0)->comment('Días de reposo médico');
            $table->decimal('medical_rest_hours', 6, 2)->default(0)->comment('Horas de reposo médico');

            $table->integer('paid_permission_days')->default(0)->comment('Días de permiso remunerado');
            $table->decimal('paid_permission_hours', 6, 2)->default(0)->comment('Horas de permiso remunerado');

            $table->integer('unpaid_permission_days')->default(0)->comment('Días de permiso no remunerado');
            $table->decimal('unpaid_permission_hours', 6, 2)->default(0)->comment('Horas de permiso no remunerado');

            $table->integer('unjustified_absence_days')->default(0)->comment('Días de inasistencia injustificada');
            $table->decimal('unjustified_absence_hours', 6, 2)->default(0)->comment('Horas de inasistencia injustificada');

            // Totales de inactividad (para resumenes)
            $table->decimal('total_non_worked_days', 6, 2)->default(0)->comment('Total de días no laborados');
            $table->decimal('total_non_worked_hours', 6, 2)->default(0)->comment('Total de horas no laboradas');

            // Salario base
            $table->decimal('base_salary_period', 10, 2)->default(0)->comment('Salario base correspondiente a la quincena');

            // Totales consolidados
            $table->decimal('total_assignments', 10, 2)->default(0)->comment('Total de asignaciones del período');
            $table->decimal('total_deductions', 10, 2)->default(0)->comment('Total de deducciones del período');
            $table->decimal('net_pay', 10, 2)->default(0)->comment('Neto a pagar al trabajador');

            $table->text('observations')->nullable()->comment('Observaciones adicionales');
            $table->boolean('status_active')->default(true)->comment('Estado del registro');
            $table->timestamps();

            // Restricciones e índices
            $table->unique(['payroll_id', 'worker_id']);
            $table->index('status_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_worker_details');
    }
};
