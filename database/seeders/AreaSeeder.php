<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Area;

class AreaSeeder extends Seeder
{
    public function run()
    {
        $areas = [
            'Dirección',
            'Subdirección',
            'Coordinación',
            'Jefatura',
            'Docente',
            'Especialista',
            'Asistencia',
            'Obrero',
            'Jardinería',
            'Logística',
            'Tecnología',
            'Atención al Cliente',
            'Investigación',
            'Desarrollo'
        ];

        foreach ($areas as $nombre) {
            Area::create([
                'name' => $nombre,
                'description' => "Descripción de la unidad: {$nombre}"
            ]);
        }
    }
}