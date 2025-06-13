<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PositionsTableSeeder extends Seeder
{
    public function run()
    {
        $positions = [
            // Personal Docente de Educación Primaria - worker_id 10+
            ['worker_id' => 10, 'area_id' => 1, 'rol_id' => 1, 'start_date' => '2006-09-01'],
            ['worker_id' => 11, 'area_id' => 1, 'rol_id' => 1, 'start_date' => '2008-10-01'],
            ['worker_id' => 12, 'area_id' => 1, 'rol_id' => 1, 'start_date' => '2018-10-08'],
            ['worker_id' => 13, 'area_id' => 1, 'rol_id' => 1, 'start_date' => '2019-05-02'],
            ['worker_id' => 14, 'area_id' => 1, 'rol_id' => 1, 'start_date' => '2020-09-16'],
            ['worker_id' => 15, 'area_id' => 1, 'rol_id' => 8, 'start_date' => '2022-09-12'],
            ['worker_id' => 16, 'area_id' => 1, 'rol_id' => 1, 'start_date' => '2023-01-16'],
            ['worker_id' => 17, 'area_id' => 1, 'rol_id' => 1, 'start_date' => '2023-09-16'],
            ['worker_id' => 18, 'area_id' => 1, 'rol_id' => 1, 'start_date' => '2023-09-11'],
            ['worker_id' => 19, 'area_id' => 1, 'rol_id' => 36, 'start_date' => '2023-09-11'],
            ['worker_id' => 20, 'area_id' => 1, 'rol_id' => 36, 'start_date' => '2023-09-11'],
            ['worker_id' => 21, 'area_id' => 1, 'rol_id' => 7, 'start_date' => '2024-09-09'],
            ['worker_id' => 22, 'area_id' => 1, 'rol_id' => 7, 'start_date' => '2024-09-19'],
            ['worker_id' => 23, 'area_id' => 1, 'rol_id' => 7, 'start_date' => '2024-09-09'],
            ['worker_id' => 24, 'area_id' => 1, 'rol_id' => 1, 'start_date' => '2024-09-13'],
            ['worker_id' => 25, 'area_id' => 1, 'rol_id' => 1, 'start_date' => '2024-09-13'],
            ['worker_id' => 26, 'area_id' => 1, 'rol_id' => 8, 'start_date' => '2024-09-09'],
            ['worker_id' => 27, 'area_id' => 1, 'rol_id' => 1, 'start_date' => '2024-09-09'],
            ['worker_id' => 28, 'area_id' => 1, 'rol_id' => 1, 'start_date' => '2024-09-09'],

            // Personal Docente de Educación Media General - worker_id 29+
            ['worker_id' => 29, 'area_id' => 2, 'rol_id' => 2, 'start_date' => '2016-11-01'],
            ['worker_id' => 30, 'area_id' => 2, 'rol_id' => 2, 'start_date' => '2018-04-02'],
            ['worker_id' => 31, 'area_id' => 2, 'rol_id' => 2, 'start_date' => '2019-01-08'],
            ['worker_id' => 32, 'area_id' => 2, 'rol_id' => 2, 'start_date' => '2019-04-05'],
            ['worker_id' => 33, 'area_id' => 2, 'rol_id' => 2, 'start_date' => '2022-09-16'],
            ['worker_id' => 34, 'area_id' => 2, 'rol_id' => 2, 'start_date' => '2022-09-16'],
            ['worker_id' => 35, 'area_id' => 2, 'rol_id' => 2, 'start_date' => '2022-09-16'],
            ['worker_id' => 36, 'area_id' => 2, 'rol_id' => 2, 'start_date' => '2022-03-14'],
            ['worker_id' => 37, 'area_id' => 2, 'rol_id' => 2, 'start_date' => '2023-09-01'],
            ['worker_id' => 38, 'area_id' => 2, 'rol_id' => 2, 'start_date' => '2023-09-11'],
            ['worker_id' => 39, 'area_id' => 2, 'rol_id' => 2, 'start_date' => '2023-09-16'],
            ['worker_id' => 40, 'area_id' => 2, 'rol_id' => 9, 'start_date' => '2020-04-01'],

            // Docentes de Inglés - worker_id 41+
            ['worker_id' => 41, 'area_id' => 3, 'rol_id' => 4, 'start_date' => '2023-09-16'],
            ['worker_id' => 42, 'area_id' => 3, 'rol_id' => 5, 'start_date' => '2018-11-08'],
            ['worker_id' => 43, 'area_id' => 3, 'rol_id' => 5, 'start_date' => '2024-09-10'],
            ['worker_id' => 44, 'area_id' => 3, 'rol_id' => 5, 'start_date' => '2024-09-10'],
            ['worker_id' => 45, 'area_id' => 3, 'rol_id' => 5, 'start_date' => '2024-09-10'],
            ['worker_id' => 46, 'area_id' => 3, 'rol_id' => 5, 'start_date' => '2024-09-10'],
            ['worker_id' => 47, 'area_id' => 3, 'rol_id' => 5, 'start_date' => '2024-09-10'],

            // Dirección y Coordinaciones Académicas - worker_id 48+
            ['worker_id' => 48, 'area_id' => 4, 'rol_id' => 10, 'start_date' => '2022-10-01'],
            ['worker_id' => 49, 'area_id' => 4, 'rol_id' => 11, 'start_date' => '2022-09-05'],
            ['worker_id' => 50, 'area_id' => 4, 'rol_id' => 12, 'start_date' => '2018-02-01'],
            ['worker_id' => 51, 'area_id' => 4, 'rol_id' => 13, 'start_date' => '2022-09-16'],
            ['worker_id' => 52, 'area_id' => 4, 'rol_id' => 14, 'start_date' => '2022-03-11'],
            ['worker_id' => 53, 'area_id' => 4, 'rol_id' => 15, 'start_date' => '2006-01-09'],
            ['worker_id' => 54, 'area_id' => 4, 'rol_id' => 16, 'start_date' => '2022-09-12'],

            // Bienestar Estudiantil - worker_id 55+
            ['worker_id' => 55, 'area_id' => 5, 'rol_id' => 18, 'start_date' => '2023-09-16'],
            ['worker_id' => 56, 'area_id' => 5, 'rol_id' => 19, 'start_date' => '2023-09-11'],
            ['worker_id' => 57, 'area_id' => 5, 'rol_id' => 20, 'start_date' => '2024-09-09'],
            ['worker_id' => 58, 'area_id' => 5, 'rol_id' => 21, 'start_date' => '2024-09-09'],
            ['worker_id' => 59, 'area_id' => 5, 'rol_id' => 22, 'start_date' => '2024-09-09'],
            ['worker_id' => 60, 'area_id' => 5, 'rol_id' => 2, 'start_date' => '2020-01-29'],

            // Personal de Mantenimiento - worker_id 61+
            ['worker_id' => 61, 'area_id' => 6, 'rol_id' => 23, 'start_date' => '1987-09-01'],
            ['worker_id' => 62, 'area_id' => 6, 'rol_id' => 24, 'start_date' => '1979-01-02'],
            ['worker_id' => 63, 'area_id' => 6, 'rol_id' => 24, 'start_date' => '1997-01-10'],
            ['worker_id' => 64, 'area_id' => 6, 'rol_id' => 23, 'start_date' => '2000-02-01'],
            ['worker_id' => 65, 'area_id' => 6, 'rol_id' => 25, 'start_date' => '2018-05-02'],
            ['worker_id' => 66, 'area_id' => 6, 'rol_id' => 23, 'start_date' => '2018-10-01'],
            ['worker_id' => 67, 'area_id' => 6, 'rol_id' => 23, 'start_date' => '2019-03-21'],
            ['worker_id' => 68, 'area_id' => 6, 'rol_id' => 26, 'start_date' => '2020-02-03'],
            ['worker_id' => 69, 'area_id' => 6, 'rol_id' => 23, 'start_date' => '2022-01-06'],
            ['worker_id' => 70, 'area_id' => 6, 'rol_id' => 28, 'start_date' => '2022-08-22'],
            ['worker_id' => 71, 'area_id' => 6, 'rol_id' => 27, 'start_date' => '2022-07-01'],
            ['worker_id' => 72, 'area_id' => 6, 'rol_id' => 26, 'start_date' => '2022-08-25'],
            ['worker_id' => 73, 'area_id' => 6, 'rol_id' => 27, 'start_date' => '2023-01-01'],
            ['worker_id' => 74, 'area_id' => 6, 'rol_id' => 25, 'start_date' => '2023-01-01'],
            ['worker_id' => 75, 'area_id' => 6, 'rol_id' => 25, 'start_date' => '2023-11-01'],
            ['worker_id' => 76, 'area_id' => 6, 'rol_id' => 27, 'start_date' => '2024-03-04'],
            ['worker_id' => 77, 'area_id' => 6, 'rol_id' => 26, 'start_date' => '2024-05-31'],
            ['worker_id' => 78, 'area_id' => 6, 'rol_id' => 26, 'start_date' => '2024-06-07'],
            ['worker_id' => 79, 'area_id' => 6, 'rol_id' => 23, 'start_date' => '2024-10-14'],
            ['worker_id' => 80, 'area_id' => 6, 'rol_id' => 23, 'start_date' => '2025-01-07'],
            ['worker_id' => 81, 'area_id' => 6, 'rol_id' => 27, 'start_date' => '2016-05-02'],

            // Personal Directivo, Administrativo y Religioso - worker_id 82+
            ['worker_id' => 82, 'area_id' => 7, 'rol_id' => 30, 'start_date' => '2017-08-01'],

            // Personal Administrativo - worker_id 83+
            ['worker_id' => 83, 'area_id' => 8, 'rol_id' => 31, 'start_date' => '2019-01-10'],
            ['worker_id' => 84, 'area_id' => 8, 'rol_id' => 32, 'start_date' => '2020-10-13'],
            ['worker_id' => 85, 'area_id' => 8, 'rol_id' => 33, 'start_date' => '2021-10-15'],
            ['worker_id' => 86, 'area_id' => 8, 'rol_id' => 34, 'start_date' => '2023-01-09'],
            ['worker_id' => 87, 'area_id' => 8, 'rol_id' => 35, 'start_date' => '2023-09-11'],

            // Personal sin cuenta nómina - worker_id 88+
            ['worker_id' => 88, 'area_id' => 9, 'rol_id' => 26, 'start_date' => '2025-01-30'],
            ['worker_id' => 89, 'area_id' => 9, 'rol_id' => 33, 'start_date' => '2025-02-03'],
            ['worker_id' => 90, 'area_id' => 9, 'rol_id' => 17, 'start_date' => '2019-05-20'],
            ['worker_id' => 91, 'area_id' => 9, 'rol_id' => 1, 'start_date' => '2025-02-10'],
            ['worker_id' => 92, 'area_id' => 9, 'rol_id' => 2, 'start_date' => '2025-03-05'],
            ['worker_id' => 93, 'area_id' => 9, 'rol_id' => 36, 'start_date' => '2025-02-10'],
        ];

        $end_dates = Carbon::now()->addYears(30)->endOfYear(); // ultimo dia del año actual;
        foreach ($positions as $position) {
            DB::table('positions')->insert([
                'start_date' => $position['start_date'],
                'end_date' => $end_dates,
                'observations' => null,
                'is_active' => true,
                'area_id' => $position['area_id'],
                'rol_id' => $position['rol_id'],
                'worker_id' => $position['worker_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
