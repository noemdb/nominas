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
        Schema::create('formulations', function (Blueprint $table) {
            $table->id()->comment('Identificador único para cada posición');
            $table->foreignId('institution_id')->comment('Institución');
            $table->string('name')->comment('Nombre');
            $table->text('description')->nullable()->comment('Descripción');
            $table->text('latex')->comment('String contentivo de la fómula');
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
        Schema::dropIfExists('formulations');
    }
};
