<?php

namespace Database\Seeders;

use App\Models\Payroll\Salary;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('es_VE');
        $arr = Salary::list_payment_status();
        for ($i=0; $i < 25; $i++) {
            DB::table('salaries')->insert([
                'employee_id' => $faker->numberBetween(1,25),
                'currency_id' => $faker->numberBetween(1,2),
                'date' =>Carbon::today()->addDays(rand(1, 180))->format('Y-m-d'),
                'amount' =>$faker->randomFloat(2, 0, 100),
                'payment_status' => $faker->randomElement($arr),
            ]);
        }
    }
}
