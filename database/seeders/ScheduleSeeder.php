<?php

namespace Database\Seeders;

use App\Models\Institution\Schedule;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleSeeder extends Seeder
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
            $arr = Schedule::list_type();
            DB::table('schedules')->insert([
                'weekday' => $faker->numberBetween(1,25),
                'hours_worked' => $faker->numberBetween(1,8),
                'start_time' => $faker->dateTime()->format('H:i'),
                'end_time' => $faker->dateTime()->format('H:i'),
                'schedule_type' => $faker->randomElement($arr),
                'area_id' => $faker->numberBetween(1,25),
                'rol_id' => $faker->numberBetween(1,25),
                'notes' => $faker->text(100),
                'start' => Carbon::today()->addDays(rand(1, 365))->format('Y-m-d'),
                'end' => Carbon::today()->addDays(rand(1, 365))->format('Y-m-d'),
            ]);
        }
    }
}
