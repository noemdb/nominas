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
        Schema::create('worker_behavior_histories', function (Blueprint $table) {
            $table->id(); // ID único del historial
            $table->foreignId('worker_behavior_id')->constrained()->onDelete('cascade')->comment('ID del registro de comportamiento laboral');
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->comment('ID del usuario que realiza la acción');
            $table->string('action')->comment('Acción realizada: creado, actualizado, eliminado, aprobado, rechazado');
            $table->json('old_values')->nullable()->comment('Valores antiguos antes del cambio');
            $table->json('new_values')->nullable()->comment('Nuevos valores después del cambio');
            $table->text('comments')->nullable()->comment('Comentarios adicionales sobre el cambio');
            $table->timestamps(); // Timestamps de creación y actualización

            // Índices para mejorar el rendimiento de las consultas
            $table->index(['worker_behavior_id', 'created_at']);
            $table->index('action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('worker_behavior_histories');
    }
};
