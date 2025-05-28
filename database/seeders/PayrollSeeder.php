<?php

namespace Database\Seeders;

use App\Models\Payroll;
use Illuminate\Database\Seeder;

class PayrollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Payroll::create([
            'name' => 'Nómina Primera Quincena Mayo 2025',
            'date_start' => '2025-05-01',
            'date_end' => '2025-05-15',
            'num_days' => 15,
            'description' => 'Nómina correspondiente a la primera quincena de mayo 2025.',
            'observations' => 'Incluye bono de alimentación.',
            'status_exchange' => false,
            'status_active' => true,
            'status_public' => false,
            'status_approved' => false,
        ]);

        Payroll::create([
            'name' => 'Nómina Segunda Quincena Mayo 2025',
            'date_start' => '2025-05-16',
            'date_end' => '2025-05-31',
            'num_days' => 16,
            'description' => 'Nómina de la segunda quincena de mayo 2025.',
            'observations' => 'Contiene deducción IVSS y FAOV.',
            'status_exchange' => false,
            'status_active' => true,
            'status_public' => false,
            'status_approved' => true,
        ]);

        Payroll::create([
            'name' => 'Nómina Especial Abril 2025',
            'date_start' => '2025-04-01',
            'date_end' => '2025-04-30',
            'num_days' => 30,
            'description' => 'Nómina mensual especial con ajustes de retroactivo.',
            'observations' => 'Incluye bonificaciones extraordinarias.',
            'status_exchange' => true,
            'status_active' => false,
            'status_public' => true,
            'status_approved' => true,
        ]);
    }
}