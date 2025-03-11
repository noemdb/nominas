<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol;

class RolSeeder extends Seeder
{
    public function run()
    {
        $rols = [
            'Dirección General',
            'Concejo Directivo',
            'Dirección Académica',
            'Dirección Administrativa',
            'Subdirecciones',
            'Coordinadores',
            'Jefes de Área',
            'Jefes de Año (Profesores Guía)',
            'Docentes de Aula',
            'Docentes por Hora',
            'Docentes Suplentes',
            'Asistentes Administrativos',
            'Auxiliares Administrativos',
            'Obrero',
            'Chofer',
            'Jardinero'
        ];

        foreach ($rols as $nombre) {
            Rol::create([
                'name' => $nombre,
                'description' => "Descripción del rol: {$nombre}"
            ]);
        }
    }
}