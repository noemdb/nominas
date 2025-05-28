<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            InstitutionSeeder::class,
            UsersTableSeeder::class,
            UsersAllTableSeeder::class,
            UsersWorkersTableSeeder::class,
            AreaSeeder::class,
            RolSeeder::class,
            PositionsTableSeeder::class,
            PayrollSeeder::class,
            DiscountSeeder::class,
            DeductionSeeder::class,
            BonusSeeder::class,
        ]);
    }
}