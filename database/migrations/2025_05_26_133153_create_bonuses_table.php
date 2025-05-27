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
        Schema::create('bonuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->foreignId('institution_id')->nullable()->constrained('institutions')->onDelete('cascade');
            $table->foreignId('area_id')->nullable()->constrained('areas')->onDelete('cascade');
            $table->foreignId('rol_id')->nullable()->constrained('rols')->onDelete('cascade');
            $table->foreignId('position_id')->nullable()->constrained('positions')->onDelete('cascade');
            $table->foreignId('worker_id')->nullable()->constrained('workers')->onDelete('cascade');
            $table->enum('type', ['fijo', 'variable']);
            $table->decimal('amount', 10, 2)->nullable();
            $table->decimal('percentage', 5, 2)->nullable();
            $table->boolean('status_exchange')->default(false);
            $table->string('name_function')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bonuses');
    }
};
