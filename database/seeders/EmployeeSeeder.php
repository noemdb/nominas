<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('es_VE');
        $arr = ['active', 'inactive', 'on leave'];
        for ($i=0; $i < 25; $i++) {
            DB::table('employees')->insert([
                'institution_id' => $faker->numberBetween(1,25),
                'name' => $faker->name,
                'ci' => $faker->randomNumber(8),
                'hire_date' =>Carbon::today()->addDays(rand(1, 365))->format('Y-m-d'),
                // 'termination_date' =>Carbon::today()->addDays(rand(1, 365))->format('Y-m-d'),
                'status' =>$faker->randomElement($arr),
                'email' => $faker->email,
            ]);
        }
    }
}
