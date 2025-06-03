<?php

namespace App\Models\TraitExtensions;

use App\Models\Discount;
use App\Models\Worker;

trait PayrollTraitDiscount
{
    /**
     * Los descuentos asociados a la nómina
     */
    public function discounts()
    {
        return $this->belongsToMany(Discount::class, 'payroll_discount')
            ->withPivot(['amount', 'status_active'])
            ->withTimestamps();
    }

    /**
     * Obtiene los descuentos activos de la nómina
     */
    public function activeDiscounts()
    {
        return $this->discounts()->wherePivot('status_active', true);
    }

    /**
     * Verifica si la nómina tiene descuentos asociados
     *
     * @return bool
     */
    public function hasDiscounts(): bool
    {
        return $this->discounts()->exists();
    }

    /**
     * Verifica si la nómina tiene descuentos activos asociados
     *
     * @return bool
     */
    public function hasActiveDiscounts(): bool
    {
        return $this->activeDiscounts()->exists();
    }

    /**
     * Obtiene los descuentos por institución
     */
    public function institutionDiscounts()
    {
        return $this->discounts()->whereNotNull('institution_id');
    }

    /**
     * Obtiene los descuentos por área
     */
    public function areaDiscounts()
    {
        return $this->discounts()->whereNotNull('area_id');
    }

    /**
     * Obtiene los descuentos por rol
     */
    public function rolDiscounts()
    {
        return $this->discounts()->whereNotNull('rol_id');
    }

    /**
     * Obtiene los descuentos por trabajador
     */
    public function workerDiscounts()
    {
        return $this->discounts()->whereNotNull('worker_id');
    }

    /**
     * Obtiene los descuentos aplicables a un trabajador según la jerarquía:
     * 1. Descuentos por institución (nivel más general)
     * 2. Descuentos por área
     * 3. Descuentos por rol
     * 4. Descuentos específicos para el trabajador (nivel más específico)
     *
     * @param Worker $worker El trabajador para el cual se buscan los descuentos
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getApplicableDiscountsForWorker(Worker $worker)
    {
        return $this->discounts()
            ->where('discounts.status_active', true)
            ->where(function ($query) use ($worker) {
                // Primero verificar descuentos por institución (nivel más general)
                $query->where(function ($q) use ($worker) {
                    $q->whereNotNull('institution_id')
                        ->where('institution_id', $worker->current_position->area->institution_id)
                        ->whereNull('area_id')
                        ->whereNull('rol_id')
                        ->whereNull('worker_id');
                })
                    // Luego verificar descuentos por área
                    ->orWhere(function ($q) use ($worker) {
                        $q->whereNotNull('area_id')
                            ->where('area_id', $worker->current_position->area_id)
                            ->whereNull('institution_id')
                            ->whereNull('rol_id')
                            ->whereNull('worker_id');
                    })
                    // Luego verificar descuentos por rol
                    ->orWhere(function ($q) use ($worker) {
                        $q->whereNotNull('rol_id')
                            ->where('rol_id', $worker->current_position->rol_id)
                            ->whereNull('institution_id')
                            ->whereNull('area_id')
                            ->whereNull('worker_id');
                    })
                    // Finalmente verificar descuentos específicos para el trabajador (nivel más específico)
                    ->orWhere(function ($q) use ($worker) {
                        $q->whereNotNull('worker_id')
                            ->where('worker_id', $worker->id)
                            ->whereNull('institution_id')
                            ->whereNull('area_id')
                            ->whereNull('rol_id');
                    });
            })
            ->where(function ($query) {
                // Verificar que el descuento esté vigente en la fecha actual
                $query->whereNull('start_date')
                    ->whereNull('end_date')
                    ->orWhere(function ($q) {
                        $q->where('start_date', '<=', now())
                            ->where(function ($q) {
                                $q->whereNull('end_date')
                                    ->orWhere('end_date', '>=', now());
                            });
                    });
            })
            ->get();
    }

    /**
     * Calcula el total de descuentos para un trabajador
     *
     * @param Worker $worker El trabajador para el cual se calculan los descuentos
     * @param float $adjustedBaseSalary El salario base ajustado
     * @param int $workedDays Los días trabajados
     * @param int $unjustifiedAbsenceDays Los días de ausencia injustificada
     * @return float
     */
    public function calculateTotalDiscountsForWorker(Worker $worker, float $adjustedBaseSalary, int $workedDays, int $unjustifiedAbsenceDays): float
    {
        $discounts = $this->getApplicableDiscountsForWorker($worker);

        return $discounts->sum(function ($discount) use ($adjustedBaseSalary, $workedDays, $unjustifiedAbsenceDays) {
            if ($discount->type === 'fijo') {
                return $discount->amount ?? 0;
            } else {
                // Calcular descuentos variables según la función
                switch ($discount->name_function) {
                    case 'by_worked_days':
                        return round($adjustedBaseSalary * (1 - ($workedDays / 15)), 2);
                    case 'by_absences':
                        return round($adjustedBaseSalary * ($unjustifiedAbsenceDays / 15), 2);
                    case 'by_delays':
                        // Asumimos un descuento del 1% del salario base por cada retardo
                        $delays = $discount->worker->behaviorHistory()
                            ->where('created_at', '>=', now()->startOfMonth())
                            ->where('type', 'delay')
                            ->count();
                        return round($adjustedBaseSalary * ($delays * 0.01), 2);
                    case 'by_permissions':
                        // Asumimos un descuento del 2% del salario base por cada permiso no remunerado
                        $permissions = $discount->worker->behaviorHistory()
                            ->where('created_at', '>=', now()->startOfMonth())
                            ->where('type', 'unpaid_permission')
                            ->count();
                        return round($adjustedBaseSalary * ($permissions * 0.02), 2);
                    default:
                        return $discount->amount ?? 0;
                }
            }
        });
    }
}
