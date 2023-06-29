<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('es_VE');
        $arr_area = ['Dirección','Admninistración'];
        for ($i=0; $i < 25; $i++) {
            DB::table('areas')->insert([
                'institution_id' => $faker->numberBetween(1,25),
                'name' => $faker->name,
                'description' =>$faker->text(100)
            ]);
        }
    }
}

/*
institution_id
name
description

'institution_id', 'name', 'description'


*/
