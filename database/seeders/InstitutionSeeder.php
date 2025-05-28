<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Institution;

class InstitutionSeeder extends Seeder
{
    public function run()
    {
        Institution::create([
            'name' => 'Instituto Nacional de Educación Avanzada',
            'description' => 'Una institución educativa de excelencia académica.',
            'address' => 'Av. Bolívar 123, Caracas, Venezuela',
            'phone' => '+58 212-555-1234',
            'email' => 'contacto@inea.edu.ve',
            'website' => 'https://inea.edu.ve',
            'director_name' => 'Dr. Juan Pérez',
            'founded_year' => 1985,
            'code' => 'CFLA',
        ]);
    }
}