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
            $table->text('observations')->nullable(); // Observaciones
            $table->boolean('is_active')->default(true); // Estado del trabajador (Activo/Inactivo)
            $table->foreignId('area_id')->constrained()->onDelete('cascade');
            $table->foreignId('rol_id')->constrained()->onDelete('cascade');
            $table->foreignId('worker_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
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
