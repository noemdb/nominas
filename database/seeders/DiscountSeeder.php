<?php

namespace Database\Seeders;

use App\Models\Discount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Discount::create([
            'name' => 'Descuento por inasistencia',
            'description' => 'Aplicado por días no laborados sin justificación.',
            'institution_id' => 1,
            'type' => 'fijo',
            'amount' => 100.00,
        ]);

        Discount::create([
            'name' => 'Descuento por préstamo',
            'description' => 'Descuento fijo mensual por adelanto de salario.',
            'institution_id' => 1,
            'type' => 'fijo',
            'amount' => 50.00,
            'status_exchange' => false,
        ]);
    }
}