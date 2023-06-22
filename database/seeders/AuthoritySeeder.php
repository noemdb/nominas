<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AuthoritySeeder extends Seeder
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
            DB::table('authorities')->insert([
                'institution_id' => $faker->numberBetween(1,25),
                'name' => $faker->name,
                'ci' => $faker->randomNumber(8),
                'position' =>$faker->word,
                'email' => $faker->email,
                'phone_number' => $faker->phoneNumber,
                'address' => $faker->address,
                'profile_professional' => $faker->word,
                'finicial' => Carbon::today()->addDays(rand(1, 365))->format('Y-m-d'),
                'ffinal' => Carbon::today()->addDays(rand(1, 365))->format('Y-m-d'),
                'photo' => $faker->imageUrl
            ]);
        }
    }
}
