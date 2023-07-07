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
        for ($i=0; $i < 25; $i++) {
            $symbol = strtoupper(substr($faker->lexify('??'), 0, 5));
            $lg = strtoupper(substr($faker->lexify('??'), 0, 5));
            $md = strtoupper(substr($faker->lexify('??'), 0, 5));
            $sm = strtoupper(substr($faker->lexify('??'), 0, 5));
            DB::table('currencies')->insert([
                'institution_id' => $faker->numberBetween(1,10),
                'name' => $faker->name,
                'symbol' => $symbol,
                'lg' =>$lg,
                'md' =>$md,
                'sm' =>$sm,
                'observations' =>$faker->text(20),
                'status_referential' =>$faker->numberBetween(0,1), //Número de tránsitoo
                'status_cripto' =>$faker->numberBetween(0,1),
                'status_forgering' =>$faker->numberBetween(0,1),
            ]);
        }
    }
}
