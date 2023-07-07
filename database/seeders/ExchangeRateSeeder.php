<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExchangeRateSeeder extends Seeder
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
            DB::table('exchange_rates')->insert([
                'currency_id' => $faker->numberBetween(1,25),
                'currency_referential_id' => $faker->numberBetween(1,25),
                'date' =>Carbon::today()->addDays(rand(1, 180))->format('Y-m-d'),
                'ammount' =>$faker->randomFloat(2, 0, 100),
                'source' =>$faker->company,
                'status_official' =>$faker->numberBetween(0,1),
                'observations' =>$faker->paragraphs(3, true), //Número de tránsitoo
            ]);
        }
    }
}
