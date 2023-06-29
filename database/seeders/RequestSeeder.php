<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RequestSeeder extends Seeder
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
            DB::table('requests')->insert([
                'employee_id' => $faker->numberBetween(1,25),
                'description' =>$faker->paragraphs(3, true),
                'days' =>$faker->numberBetween(1,25),
                'start' => Carbon::today()->addDays(rand(1, 180))->format('Y-m-d'),
                'end' => Carbon::today()->addDays(rand(180, 365))->format('Y-m-d'),
                'payout' =>$faker->numberBetween(0,1),
            ]);
        }
    }
}
/*
employee_id
description
days
start
end
payout
*/
