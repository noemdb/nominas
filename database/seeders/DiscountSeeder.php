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
        // Descuento por inasistencia injustificada
        Discount::create([
            'name' => 'Descuento por inasistencia injustificada',
            'description' => 'Aplicado por días no laborados sin justificación válida.',
            'institution_id' => 1,
            'type' => 'fijo',
            'percentage' => 100.00, // 100% del día no laborado
            'status_exchange' => false,
            'status_active' => true,
        ]);

        // Descuento por adelanto de salario (préstamo)
        Discount::create([
            'name' => 'Descuento por adelanto de salario',
            'description' => 'Descuento mensual por concepto de préstamo o adelanto otorgado al trabajador.',
            'institution_id' => 1,
            'type' => 'fijo',
            'amount' => 50.00,
            'status_exchange' => false,
            'status_active' => true,
        ]);

        // Descuento personalizado por adelanto a un trabajador específico (ej: ID 12)
        Discount::create([
            'name' => 'Descuento personal por adelanto',
            'description' => 'Aplicado directamente al trabajador por adelanto de salario.',
            'worker_id' => 12,
            'type' => 'fijo',
            'amount' => 50.00,
            'status_exchange' => false,
            'status_active' => true,
        ]);
    }
}
