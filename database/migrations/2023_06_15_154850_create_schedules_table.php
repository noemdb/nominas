<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('weekday')->comment('Día de la semana');
            $table->time('start_time')->comment('Hora de inicio');
            $table->time('end_time')->comment('Hora de finalización');
            $table->string('schedule_type')->comment('Tipo de horario(Diurno/Nocturno)');
            $table->foreignId('area_id')->comment('Área');
            $table->foreignId('rol_id')->comment('Rol');
            $table->text('notes')->nullable()->comment('Notas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
};
