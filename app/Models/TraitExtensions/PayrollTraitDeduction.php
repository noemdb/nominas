<?php

namespace App\Models\TraitExtensions;

use App\Models\Deduction;
use App\Models\Worker;

trait PayrollTraitDeduction
{
    /**
     * Las deducciones asociadas a la nómina
     */
    public function deductions()
    {
        return $this->belongsToMany(Deduction::class, 'payroll_deduction')
            ->withPivot(['amount', 'status_active'])
            ->withTimestamps();
    }

    /**
     * Obtiene las deducciones activas de la nómina
     */
    public function activeDeductions()
    {
        return $this->deductions()->wherePivot('status_active', true);
    }

    /**
     * Verifica si la nómina tiene deducciones asociadas
     *
     * @return bool
     */
    public function hasDeductions(): bool
    {
        return $this->deductions()->exists();
    }

    /**
     * Verifica si la nómina tiene deducciones activas asociadas
     *
     * @return bool
     */
    public function hasActiveDeductions(): bool
    {
        return $this->activeDeductions()->exists();
    }

    /**
     * Obtiene las deducciones por institución
     */
    public function institutionDeductions()
    {
        return $this->deductions()->whereNotNull('institution_id');
    }

    /**
     * Obtiene las deducciones por área
     */
    public function areaDeductions()
    {
        return $this->deductions()->whereNotNull('area_id');
    }

    /**
     * Obtiene las deducciones por rol
     */
    public function rolDeductions()
    {
        return $this->deductions()->whereNotNull('rol_id');
    }

    /**
     * Obtiene las deducciones por trabajador
     */
    public function workerDeductions()
    {
        return $this->deductions()->whereNotNull('worker_id');
    }

    /**
     * Obtiene las deducciones aplicables a un trabajador según la jerarquía:
     * 1. Deducciones por institución (nivel más general)
     * 2. Deducciones por área
     * 3. Deducciones por rol
     * 4. Deducciones específicas para el trabajador (nivel más específico)
     *
     * @param Worker $worker El trabajador para el cual se buscan las deducciones
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getApplicableDeductionsForWorker(Worker $worker)
    {
        return $this->deductions()
            ->where('deductions.status_active', true)
            ->where(function ($query) use ($worker) {
                // Primero verificar deducciones por institución (nivel más general)
                $query->where(function ($q) use ($worker) {
                    $q->whereNotNull('institution_id')
                        ->where('institution_id', $worker->current_position->area->institution_id)
                        ->whereNull('area_id')
                        ->whereNull('rol_id')
                        ->whereNull('worker_id');
                })
                    // Luego verificar deducciones por área
                    ->orWhere(function ($q) use ($worker) {
                        $q->whereNotNull('area_id')
                            ->where('area_id', $worker->current_position->area_id)
                            ->whereNull('institution_id')
                            ->whereNull('rol_id')
                            ->whereNull('worker_id');
                    })
                    // Luego verificar deducciones por rol
                    ->orWhere(function ($q) use ($worker) {
                        $q->whereNotNull('rol_id')
                            ->where('rol_id', $worker->current_position->rol_id)
                            ->whereNull('institution_id')
                            ->whereNull('area_id')
                            ->whereNull('worker_id');
                    })
                    // Finalmente verificar deducciones específicas para el trabajador (nivel más específico)
                    ->orWhere(function ($q) use ($worker) {
                        $q->whereNotNull('worker_id')
                            ->where('worker_id', $worker->id)
                            ->whereNull('institution_id')
                            ->whereNull('area_id')
                            ->whereNull('rol_id');
                    });
            })
            ->get();
    }

    /**
     * Calcula el total de deducciones para un trabajador
     *
     * @param Worker $worker El trabajador para el cual se calculan las deducciones
     * @param float $adjustedBaseSalary El salario base ajustado
     * @param int $workedDays Los días trabajados
     * @param int $unjustifiedAbsenceDays Los días de ausencia injustificada
     * @return float
     */
    public function calculateTotalDeductionsForWorker(Worker $worker, float $adjustedBaseSalary, int $workedDays, int $unjustifiedAbsenceDays): float
    {
        $deductions = $this->getApplicableDeductionsForWorker($worker);

        return $deductions->sum(function ($deduction) use ($adjustedBaseSalary, $workedDays, $unjustifiedAbsenceDays, $worker) {
            if ($deduction->type === 'fijo') {
                return $deduction->amount ?? 0;
            } else {
                // Calcular deducciones variables según la función
                switch ($deduction->name_function) {
                    case 'by_worked_days':
                        return round($adjustedBaseSalary * (1 - ($workedDays / 15)), 2);
                    case 'by_absences':
                        return round($adjustedBaseSalary * ($unjustifiedAbsenceDays / 15), 2);
                    case 'by_delays':
                        // Asumimos un descuento del 1% del salario base por cada retardo
                        $delays = $worker->behaviorHistory()
                            ->where('created_at', '>=', now()->startOfMonth())
                            ->where('type', 'delay')
                            ->count();
                        return round($adjustedBaseSalary * ($delays * 0.01), 2);
                    case 'by_permissions':
                        // Asumimos un descuento del 2% del salario base por cada permiso no remunerado
                        $permissions = $worker->behaviorHistory()
                            ->where('created_at', '>=', now()->startOfMonth())
                            ->where('type', 'unpaid_permission')
                            ->count();
                        return round($adjustedBaseSalary * ($permissions * 0.02), 2);
                    default:
                        return $deduction->amount ?? 0;
                }
            }
        });
    }
}
