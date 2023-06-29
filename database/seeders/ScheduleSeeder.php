<?php

namespace Database\Seeders;

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
            // $timestamp = $faker->time();
            // $hora = date('H:i', $timestamp);
            DB::table('schedules')->insert([
                'weekday' => $faker->numberBetween(1,25),
                'start_time' => $faker->dateTime()->format('H:i'),
                'end_time' => $faker->dateTime()->format('H:i'),
                'schedule_type' => $faker->word,
                'area_id' => $faker->numberBetween(1,25),
                'rol_id' => $faker->numberBetween(1,25),
                'notes' => $faker->text(100),
            ]);
        }
    }
}
