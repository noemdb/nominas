<?php

namespace Database\Seeders;

use App\Models\Institution\Bank;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('es_VE');
        $arr = ['Esposo(a)','Hermano(a)','Padre','Madre','Otro'];
        $arr_disability = ['Visual','Auditiva','Motora','Intelectual','Psicosocial'];
        $arr_bank = Bank::all()->pluck('id');
        for ($i=0; $i < 25; $i++) {
            DB::table('personals')->insert([
                'employee_id' => $faker->numberBetween(1,25),
                'address' => $faker->address,
                'city' => $faker->city,
                'state' =>$faker->state,
                'zip_code' =>$faker->postcode('ES'),
                'country' =>$faker->country,
                'phone_number' => $faker->phoneNumber,
                'home_phone' => $faker->phoneNumber,
                'bank_id' => $faker->randomElement($arr_bank),
                'bank_account_number' => $faker->numerify('####################'),
                'emergency_contact_name' => $faker->name,
                'emergency_contact_relationship' => $faker->randomElement($arr),
                'emergency_contact_phone' => $faker->phoneNumber,
                'emergency_contact_email' => $faker->email,
                'disability' => $faker->randomElement($arr_disability),
                'other_details' => $faker->text,
            ]);
        }
    }
}
