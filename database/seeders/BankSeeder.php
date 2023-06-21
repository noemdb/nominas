<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('es_VE');
        for ($i=0; $i < 25; $i++) {
            $acronimo = strtoupper(substr($faker->lexify('??'), 0, 5));
            DB::table('banks')->insert([
                'institution_id' => $faker->numberBetween(1,10), //Institución
                'name' => $faker->name, //Nombre completo
                'acronym' =>$acronimo, //Acrónimo
                'branch' =>$faker->company, //Sucursal, si es aplicable
                'account_number' =>$faker->text(30), //Número de cuenta
                'account_type' =>$faker->text(20), //Tipo de cuenta bancaria
                'routing_number' =>$faker->text(15), //Número de tránsitoo
                'swift_code' =>$faker->randomNumber(3), //SWIFT
                'iban' =>$faker->randomNumber(4), //International Bank Account Number
                'contact_person' =>$faker->name, //Persona de Contacto
                'phone_number' =>$faker->phoneNumber, //Teléfono
                'email' =>$faker->email, //la dirección de correo electrónico
                'address' =>$faker->address, //la dirección física
            ]);
        }
    }
}
