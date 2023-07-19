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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id()->comment('Identificador único para cada registro de nómina');
            $table->foreignId('institution_id')->comment('Institución');
            $table->string('level_id')->comment('El nivel de nómina (por ejemplo, Presidencia, Gerencia, Supervisión, Trabajador, Obrero.)');
            $table->string('frequency')->comment('La frecuencia de la liquidación de la nómina (por Semanal, Quincenal, Mensual, Bimensual, Trimestral, Cuatrimestral, Semestral, etc.)');
            $table->string('name')->comment('Nombre completo');
            $table->text('description')->nullable()->comment('Descripción');
            $table->boolean('status')->default(true)->comment('Estado [Activo/Desactivo]');
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
        Schema::dropIfExists('payrolls');
    }
};
