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
        Schema::create('payroll_worker_behavior', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payroll_id')->constrained()->onDelete('cascade');
            $table->foreignId('worker_behavior_id')->constrained('worker_behaviors')->onDelete('cascade');
            $table->decimal('bonus_amount', 10, 2)->nullable()->comment('Monto de bonificación aplicado en la nómina');
            $table->decimal('discount_amount', 10, 2)->nullable()->comment('Monto de descuento aplicado en la nómina');
            $table->boolean('status_active')->default(true);
            $table->timestamps();

            // Índices
            $table->unique(['payroll_id', 'worker_behavior_id']);
            $table->index('status_active');
            $table->index(['bonus_amount', 'discount_amount']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_worker_behavior');
    }
};
