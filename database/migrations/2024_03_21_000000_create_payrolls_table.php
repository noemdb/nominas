<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('date_start');
            $table->date('date_end');
            $table->integer('num_days');
            $table->integer('num_weeks')->default(4)->comment('Número de semanas del mes para el cálculo de la nómina');
            $table->text('description')->nullable();
            $table->text('observations')->nullable();
            $table->boolean('status_exchange')->default(false);
            $table->boolean('status_active')->default(true);
            $table->boolean('status_public')->default(false);
            $table->boolean('status_approved')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
