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
            'worker_id' => 24,
            'type' => 'fijo',
            'amount' => 10.00, // 100% del día no laborado
            'status_exchange' => false,
            'status_active' => true,
            'start_date' => '2025-04-01',
            'end_date' => '2025-06-31',
        ]);

        // Descuento por adelanto de salario (préstamo)
        Discount::create([
            'name' => 'Descuento por adelanto de salario',
            'description' => 'Descuento mensual por concepto de préstamo o adelanto otorgado al trabajador.',
            'worker_id' => 17,
            'type' => 'fijo',
            'amount' => 5.00,
            'status_exchange' => false,
            'status_active' => true,
            'start_date' => '2025-04-01',
            'end_date' => '2025-06-31',
        ]);

        // Descuento personalizado por adelanto a un trabajador específico (ej: ID 12)
        Discount::create([
            'name' => 'Descuento personal por adelanto',
            'description' => 'Aplicado directamente al trabajador por adelanto de salario.',
            'worker_id' => 12,
            'type' => 'fijo',
            'amount' => 5.00,
            'status_exchange' => false,
            'status_active' => true,
            'start_date' => '2025-04-01',
            'end_date' => '2025-06-31',
        ]);
    }
}
