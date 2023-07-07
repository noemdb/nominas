<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('es_VE');

        DB::table('currencies')->insert([
            'institution_id' => $faker->numberBetween(1,10),
            'name' => 'Bolívar',
            'symbol' => 'Bs',
            'lg' =>'Bs',
            'md' =>'Bs',
            'sm' =>'Bs',
            'observations' =>'Modena nacional',
            'status_referential' =>false,
            'status_cripto' =>false,
            'status_forgering' =>false,
        ]);

        DB::table('currencies')->insert([
            'institution_id' => $faker->numberBetween(1,10),
            'name' => 'Dolar',
            'symbol' => 'USD',
            'lg' =>'$',
            'md' =>'$',
            'sm' =>'$',
            'observations' =>'Modena de referencia',
            'status_referential' =>true,
            'status_cripto' =>false,
            'status_forgering' =>true,
        ]);

        $fakerEN = Factory::create();
        for ($i=0; $i < 5; $i++) {
            DB::table('currencies')->insert([
                'institution_id' => $faker->numberBetween(1,10),
                'name' => $fakerEN->firstName(),
                'symbol' => $faker->currencyCode(),
                'lg' => $faker->currencyCode(),
                'md' => $faker->currencyCode(),
                'sm' => $faker->currencyCode(),
                'observations' =>$faker->text(20),
                'status_referential' =>$faker->numberBetween(0,1),
                'status_cripto' =>$faker->numberBetween(0,1),
                'status_forgering' =>$faker->numberBetween(0,1),
            ]);
        }
    }
}
