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
        Schema::create('weekly_work_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('position_id')->constrained()->onDelete('cascade');
            $table->enum('day_of_week', ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']);
            $table->decimal('planned_hours', 5, 2)->unsigned();
            $table->boolean('is_active')->default(true);
            $table->text('observations')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Ensure unique combination of position and day
            $table->unique(['position_id', 'day_of_week']);

            // Index for faster queries
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weekly_work_schedules');
    }
};
