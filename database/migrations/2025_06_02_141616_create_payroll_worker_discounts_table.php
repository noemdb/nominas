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
        Schema::create('payroll_worker_discounts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('payroll_worker_detail_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('Detalle de nómina del trabajador');

            $table->foreignId('discount_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('ID del descuento aplicado');

            $table->decimal('amount', 10, 2)
                ->default(0)
                ->comment('Monto del descuento aplicado');

            $table->boolean('status_active')
                ->default(true)
                ->comment('Indica si el descuento está activo en esta nómina');

            $table->timestamps();

            $table->unique(['payroll_worker_detail_id', 'discount_id'], 'pwd_payroll_detail_discount_unique');
            $table->index('status_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_worker_discounts');
    }
};
