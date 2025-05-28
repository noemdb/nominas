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
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->date('start_date'); // Inicio
            $table->date('end_date'); // Fin
            $table->foreignId('area_id')->constrained()->onDelete('cascade');
            $table->foreignId('rol_id')->constrained()->onDelete('cascade');
            $table->foreignId('worker_id')->constrained()->onDelete('cascade');

            $table->decimal('base_salary', 10, 2)->default(0);
            $table->boolean('status_exchange')->default(false);
            $table->text('observations')->nullable(); // Observaciones
            $table->boolean('status_active')->default(true);
            $table->boolean('is_active')->nullable()->default(true); // Estado del trabajador (Activo/Inactivo)
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('positions');
    }
};