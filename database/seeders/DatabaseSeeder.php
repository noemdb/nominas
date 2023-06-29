<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call(InstitutionSeeder::class);
        $this->call(AuthoritySeeder::class);
        $this->call(BankSeeder::class);
        $this->call(AreaSeeder::class);
        $this->call(RolSeeder::class);
        $this->call(ScheduleSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(PersonalSeeder::class);
        $this->call(PositionSeeder::class);

        ///////////////////////////////////
        $this->call(RequestSeeder::class);
    }
}
