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
        Schema::create('payroll_worker_bonuses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('payroll_worker_detail_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('Detalle de nómina del trabajador');

            $table->foreignId('bonus_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('ID de la bonificación aplicada');

            $table->decimal('amount', 10, 2)
                ->default(0)
                ->comment('Monto de la bonificación aplicada');

            $table->boolean('status_active')
                ->default(true)
                ->comment('Indica si la bonificación está activa en esta nómina');

            $table->timestamps();

            $table->unique(['payroll_worker_detail_id', 'bonus_id']);
            $table->index('status_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_worker_bonuses');
    }
};
