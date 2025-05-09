<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('ALTER TABLE areas AUTO_INCREMENT = 10;');

        $areas = [
            ['id' => 1, 'name' => 'DOCENTE DE EDUCACIÓN PRIMARIA', 'description' => 'Docentes de Educación Primaria'],
            ['id' => 2, 'name' => 'DOCENTE DE EDUCACION MEDIA GENERAL', 'description' => 'Docentes de Educación Media General'],
            ['id' => 3, 'name' => 'DOCENTES DE INGLES', 'description' => 'Docentes de Inglés'],
            ['id' => 4, 'name' => 'DIRECCION Y COORDINACIONES ACADEMICAS', 'description' => 'Dirección y Coordinaciones Académicas'],
            ['id' => 5, 'name' => 'BIENESTAR ESTUDIANTIL', 'description' => 'Personal de Bienestar Estudiantil'],
            ['id' => 6, 'name' => 'PERSONAL DE MANTENIMIENTO', 'description' => 'Personal de Mantenimiento'],
            ['id' => 7, 'name' => 'PERSONAL DIRECTIVO, ADMINISTRATIVO Y RELIGIOSO', 'description' => 'Directivos, administrativos y religiosos'],
            ['id' => 8, 'name' => 'PERSONAL ADMINISTRATIVO', 'description' => 'Personal Administrativo'],
            ['id' => 9, 'name' => 'PERSONAL SIN CUENTA NOMINA', 'description' => 'Personal sin cuenta nómina'],
        ];

        foreach ($areas as $area) {
            DB::table('areas')->updateOrInsert(
                ['id' => $area['id']],
                [
                    'name' => $area['name'],
                    'description' => $area['description'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );
        }
    }
}
