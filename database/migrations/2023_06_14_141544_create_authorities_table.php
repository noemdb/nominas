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
        Schema::create('authorities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id');
            $table->string('name')->comment('Nombre completo');
            $table->string('position')->comment('Cargo');
            $table->string('email')->comment('Dirección de correo electrónico');
            $table->string('phone_number')->comment('número de teléfono');
            $table->string('address')->comment('Dirección');
            $table->string('profile_professional')->comment('Perfíl profesional');
            $table->date('finicial')->comment('F.Inicial');
            $table->date('ffinal')->comment('F.Inicial');
            $table->string('photo')->comment('Imagen')->nullable();
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
        Schema::dropIfExists('authorities');
    }
};
