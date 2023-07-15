<?php

namespace Database\Seeders;

use App\Models\Employee\Position;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('es_VE');
        $arr = Position::list_frequency_workday();
        $arr_type = Position::list_contract_type();
        for ($i=0; $i < 25; $i++) {
            DB::table('positions')->insert([
                'employee_id' => $faker->numberBetween(1,25),
                'area_id' => $faker->numberBetween(1,25),
                'rol_id' => $faker->numberBetween(1,25),
                'name' =>$faker->name,
                'description' =>$faker->paragraphs(3, true),
                'contract_type' =>$faker->randomElement($arr_type),
                'start' => Carbon::today()->addDays(rand(1, 180))->format('Y-m-d'),
                'end' => Carbon::today()->addDays(rand(180, 365))->format('Y-m-d'),
                'start_salary' => Carbon::today()->addDays(rand(1, 180))->format('Y-m-d'),
                'status' =>$faker->numberBetween(0,1),
                'frequency_workday' =>$faker->randomElement($arr),
                'workday' =>$faker->numberBetween(1,100),
            ]);
        }
    }
}
