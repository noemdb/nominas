<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutions', function (Blueprint $table) {
            $table->id()->comment('Identificador único para cada institución');
            $table->string('name')->comment('Nombre completo de la institución');
            $table->string('type')->comment('Tipo de la institución');
            $table->string('acronym')->nullable()->comment('Acrónimo o sigla de la institución, si lo tiene');
            $table->string('address')->comment('Dirección física de la institución');
            $table->string('phone_number')->comment('Número de teléfono de la institución');
            $table->string('email')->comment('Dirección de correo electrónico de la institución');
            $table->string('website')->nullable()->comment('Dirección del sitio web de la institución, si lo tiene');
            $table->date('foundation_date')->nullable()->comment('Fecha de fundación de la institución, si se conoce');
            $table->boolean('legal_status')->comment('Estado legal de la institución (por ejemplo, empresa, organización sin fines de lucro, etc.)');
            $table->string('tax_id')->nullable()->comment('Número de identificación fiscal de la institución, si se conoce');
            $table->string('registration_number')->nullable()->comment('Número de registro de la institución, si se conoce');
            $table->string('logo')->nullable()->comment('Imagen del logo de la institución, almacenada como un archivo en la base de datos o en un servidor de archivos externo');
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
        Schema::dropIfExists('institutions');
    }
}
