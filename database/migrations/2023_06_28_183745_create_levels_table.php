<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Nombre del nivel: General, Presidencia, Alto nivel, Gerencia, etc');
            $table->string('description')->nullable()->comment('Descripción');
            $table->timestamps();
        });

        $data = [
            [ 'name' => 'General', 'description' => 'Nómina General, todos los trabajadores'],
            [ 'name' => 'Alto nivel', 'description' => 'Nómina de Alto nivel'],
            [ 'name' => 'Presidencia', 'description' => 'Nómina del Presidente'],
            [ 'name' => 'Gerencia', 'description' => 'Nómina Gerencial'],
            [ 'name' => 'Supervisiores', 'description' => 'Nómina Supervisión'],
            [ 'name' => 'Empleados', 'description' => 'Nómina Empleados'],
        ];

        DB::table('levels')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('levels');
    }
};
