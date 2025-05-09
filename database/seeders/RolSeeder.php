<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('ALTER TABLE rols AUTO_INCREMENT = 10;');

        $roles = [
            // Docentes
            ['id' => 1, 'name' => 'DOCENTE DE AULA', 'description' => 'Docente de aula'],
            ['id' => 2, 'name' => 'DOCENTE POR HORA', 'description' => 'Docente por hora'],
            ['id' => 3, 'name' => 'JEFE PROYECTO', 'description' => 'Jefe de Proyecto'],
            ['id' => 4, 'name' => 'JEFE PROYECTO INGLES', 'description' => 'Jefe de Proyecto Inglés'],
            ['id' => 5, 'name' => 'DOCENTE INGLES', 'description' => 'Docente de Inglés'],
            ['id' => 6, 'name' => 'DOCENTE ROBOTICA', 'description' => 'Docente de Robótica'],
            ['id' => 7, 'name' => 'DOCENTE INICIAL', 'description' => 'Docente de Educación Inicial'],
            ['id' => 8, 'name' => 'FHC', 'description' => 'Docente FHC (Fondo de Horas Complementarias)'],
            ['id' => 9, 'name' => 'INNOV. TECN./ROBOTICA', 'description' => 'Innovación Tecnológica / Robótica'],

            // Dirección y Coordinaciones
            ['id' => 10, 'name' => 'DIR. ACADEMICO', 'description' => 'Director Académico'],
            ['id' => 11, 'name' => 'SUD DIRECTOR ACAD.', 'description' => 'Subdirector Académico'],
            ['id' => 12, 'name' => 'COORD. REG. Y CONT. EST.', 'description' => 'Coordinador Registro y Control Estudiantil'],
            ['id' => 13, 'name' => 'COORD. DE EVALUACIÓN', 'description' => 'Coordinador de Evaluación'],
            ['id' => 14, 'name' => 'COORD. PRIMERA ETAPA', 'description' => 'Coordinador Primera Etapa'],
            ['id' => 15, 'name' => 'COORD. SEGUNDA ETAPA', 'description' => 'Coordinador Segunda Etapa'],
            ['id' => 16, 'name' => 'COOR. BIENESTAR EST', 'description' => 'Coordinador Bienestar Estudiantil'],
            ['id' => 17, 'name' => 'COORD. DE PASTORAL', 'description' => 'Coordinador de Pastoral'],

            // Bienestar Estudiantil
            ['id' => 18, 'name' => 'DOCENTE DEPORTE', 'description' => 'Docente de Deportes'],
            ['id' => 19, 'name' => 'AULA INTEGRADA', 'description' => 'Aula Integrada'],
            ['id' => 20, 'name' => 'PSICOPEDAGOGO', 'description' => 'Psicopedagogo'],
            ['id' => 21, 'name' => 'PSICOLOGO', 'description' => 'Psicólogo'],
            ['id' => 22, 'name' => 'ORIENTADOR', 'description' => 'Orientador'],

            // Personal de Mantenimiento
            ['id' => 23, 'name' => 'ASEADORA', 'description' => 'Aseadora'],
            ['id' => 24, 'name' => 'ASEADOR', 'description' => 'Aseador'],
            ['id' => 25, 'name' => 'SERVICIOS GRALES', 'description' => 'Servicios Generales'],
            ['id' => 26, 'name' => 'VIGILANTE', 'description' => 'Vigilante'],
            ['id' => 27, 'name' => 'JARDINERO', 'description' => 'Jardinero'],
            ['id' => 28, 'name' => 'SUP. SERV. GRALES', 'description' => 'Supervisor Servicios Generales'],
            ['id' => 29, 'name' => 'SUPERVISOR MANTTO.', 'description' => 'Supervisor de Mantenimiento'],

            // Personal Directivo y Administrativo
            ['id' => 30, 'name' => 'DIRECTOR GENERAL', 'description' => 'Director General'],
            ['id' => 31, 'name' => 'ASIST ADM. CONTROL EST', 'description' => 'Asistente Administrativo de Control Estudiantil'],
            ['id' => 32, 'name' => 'ADMINISTRADORA ADJUNTA', 'description' => 'Administradora Adjunta'],
            ['id' => 33, 'name' => 'ASIST ADMINISTRATIVO', 'description' => 'Asistente Administrativo'],
            ['id' => 34, 'name' => 'ASIST. DIR. ACADEMICO', 'description' => 'Asistente Dirección Académica'],
            ['id' => 35, 'name' => 'TECNICO INFORMATICA', 'description' => 'Técnico en Informática'],
            ['id' => 36, 'name' => 'DOCENTE POR HORA INNOVACION TECNOLOGICA', 'description' => 'Docente por Hora - Innovación Tecnológica'],
        ];

        foreach ($roles as $rol) {
            DB::table('rols')->updateOrInsert(
                ['id' => $rol['id']],
                [
                    'name' => $rol['name'],
                    'description' => $rol['description'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );
        }
    }
}
