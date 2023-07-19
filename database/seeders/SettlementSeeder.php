<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettlementSeeder extends Seeder
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
            DB::table('settlements')->insert([
                'employee_id' => $faker->numberBetween(1,25),
                'date' =>Carbon::today()->addDays(rand(1, 180))->format('Y-m-d'),
                'gross_salary' =>$faker->randomFloat(2, 0, 100),
                'net_salary' =>$faker->randomFloat(2, 0, 100),
                'tax_deductions' =>$faker->randomFloat(2, 0, 100),
                'other_deductions' =>$faker->randomFloat(2, 0, 100),
                'total_deductions' =>$faker->randomFloat(2, 0, 100),
                'total_additions' =>$faker->randomFloat(2, 0, 100),
                'total_pay' =>$faker->randomFloat(2, 0, 100),
            ]); //'employee_id','frequency','amount'
        }
    }
}
