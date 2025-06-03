<?php

namespace App\Exports;

use App\Models\Payroll;
use App\Models\PayrollWorkerDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\Log;

class PayrollDetailsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $payroll;

    public function __construct(Payroll $payroll)
    {
        $this->payroll = $payroll;
    }

    public function collection()
    {
        try {
            Log::info('Iniciando collection en PayrollDetailsExport', [
                'payroll_id' => $this->payroll->id,
                'payroll_name' => $this->payroll->name
            ]);

            $details = PayrollWorkerDetail::where('payroll_id', $this->payroll->id)
                ->with([
                    'worker:id,first_name,last_name',
                    'position:id,area_id,rol_id',
                    'position.area:id,name',
                    'position.rol:id,name',
                    'bonuses' => function ($query) {
                        $query->where('status_active', true)
                            ->with('bonus:id,name,type');
                    },
                    'deductions' => function ($query) {
                        $query->where('status_active', true)
                            ->with('deduction:id,name,type');
                    },
                    'discounts' => function ($query) {
                        $query->where('status_active', true)
                            ->with('discount:id,name,type');
                    }
                ])
                ->where('status_active', true)
                ->get();

            Log::info('Detalles cargados exitosamente', [
                'payroll_id' => $this->payroll->id,
                'details_count' => $details->count()
            ]);

            return $details;
        } catch (\Exception $e) {
            Log::error('Error en collection de PayrollDetailsExport', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'payroll_id' => $this->payroll->id ?? 'no disponible',
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);
            throw $e;
        }
    }

    public function headings(): array
    {
        return [
            'Trabajador',
            'Área',
            'Cargo',
            'Días Trabajados',
            'Horas Académicas',
            'Horas Administrativas',
            'Salario Base',
            'Asignaciones',
            'Deducciones',
            'Neto a Pagar',
            'Días Reposo Médico',
            'Días Permiso Pagado',
            'Días Permiso No Pagado',
            'Días Ausencia Injustificada',
            'Observaciones'
        ];
    }

    public function map($detail): array
    {
        try {
            Log::debug('Mapeando detalle', [
                'detail_id' => $detail->id,
                'worker_id' => $detail->worker_id
            ]);

            $data = [
                $detail->worker?->full_name ?? 'N/A',
                $detail->position?->area?->name ?? 'N/A',
                $detail->position?->rol?->name ?? 'N/A',
                $detail->worked_days ?? 0,
                number_format($detail->academic_hours + $detail->administrative_hours, 2),
                number_format($detail->base_salary_period, 2),
                number_format($detail->total_assignments - $detail->base_salary_period, 2),
                number_format($detail->total_deductions, 2),
                $detail->observations ?? ''
            ];

            Log::debug('Detalle mapeado exitosamente', [
                'detail_id' => $detail->id,
                'data_length' => count($data)
            ]);

            return $data;
        } catch (\Exception $e) {
            Log::error('Error en map de PayrollDetailsExport', [
                'error' => $e->getMessage(),
                'detail_id' => $detail->id ?? 'no disponible',
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);
            throw $e;
        }
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            'A1:O1' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'E2E8F0']
                ]
            ],
            'A:O' => [
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                ]
            ]
        ];
    }
}
