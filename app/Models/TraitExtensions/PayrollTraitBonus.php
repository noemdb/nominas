<?php

namespace App\Models\TraitExtensions;

use App\Models\Bonus;
use App\Models\Worker;

trait PayrollTraitBonus
{
    /**
     * Las bonificaciones asociadas a la nómina
     */
    public function bonuses()
    {
        return $this->belongsToMany(Bonus::class, 'payroll_bonus')
            ->withPivot(['amount', 'status_active'])
            ->withTimestamps();
    }

    /**
     * Obtiene las bonificaciones activas de la nómina
     */
    public function activeBonuses()
    {
        return $this->bonuses()->wherePivot('status_active', true);
    }

    /**
     * Verifica si la nómina tiene bonificaciones asociadas
     *
     * @return bool
     */
    public function hasBonuses(): bool
    {
        return $this->bonuses()->exists();
    }

    /**
     * Verifica si la nómina tiene bonificaciones activas asociadas
     *
     * @return bool
     */
    public function hasActiveBonuses(): bool
    {
        return $this->activeBonuses()->exists();
    }

    /**
     * Obtiene las bonificaciones por institución
     */
    public function institutionBonuses()
    {
        return $this->bonuses()->whereNotNull('institution_id');
    }

    /**
     * Obtiene las bonificaciones por área
     */
    public function areaBonuses()
    {
        return $this->bonuses()->whereNotNull('area_id');
    }

    /**
     * Obtiene las bonificaciones por rol
     */
    public function rolBonuses()
    {
        return $this->bonuses()->whereNotNull('rol_id');
    }

    /**
     * Obtiene las bonificaciones por trabajador
     */
    public function workerBonuses()
    {
        return $this->bonuses()->whereNotNull('worker_id');
    }

    /**
     * Obtiene las bonificaciones aplicables a un trabajador según la jerarquía:
     * 1. Bonificaciones por institución (nivel más general)
     * 2. Bonificaciones por área
     * 3. Bonificaciones por rol
     * 4. Bonificaciones específicas para el trabajador (nivel más específico)
     *
     * @param Worker $worker El trabajador para el cual se buscan las bonificaciones
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getApplicableBonusesForWorker(Worker $worker)
    {
        return $this->bonuses()
            ->where('bonuses.status_active', true)
            ->where(function ($query) use ($worker) {
                // Primero verificar bonificaciones por institución (nivel más general)
                $query->where(function ($q) use ($worker) {
                    $q->whereNotNull('institution_id')
                        ->where('institution_id', $worker->current_position->area->institution_id)
                        ->whereNull('area_id')
                        ->whereNull('rol_id')
                        ->whereNull('worker_id');
                })
                    // Luego verificar bonificaciones por área
                    ->orWhere(function ($q) use ($worker) {
                        $q->whereNotNull('area_id')
                            ->where('area_id', $worker->current_position->area_id)
                            ->whereNull('institution_id')
                            ->whereNull('rol_id')
                            ->whereNull('worker_id');
                    })
                    // Luego verificar bonificaciones por rol
                    ->orWhere(function ($q) use ($worker) {
                        $q->whereNotNull('rol_id')
                            ->where('rol_id', $worker->current_position->rol_id)
                            ->whereNull('institution_id')
                            ->whereNull('area_id')
                            ->whereNull('worker_id');
                    })
                    // Finalmente verificar bonificaciones específicas para el trabajador (nivel más específico)
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
     * Calcula el total de bonificaciones para un trabajador
     *
     * @param Worker $worker El trabajador para el cual se calculan las bonificaciones
     * @param float $adjustedBaseSalary El salario base ajustado
     * @param int $workedDays Los días trabajados
     * @return float
     */
    public function calculateTotalBonusesForWorker(Worker $worker, float $adjustedBaseSalary, int $workedDays): float
    {
        $bonuses = $this->getApplicableBonusesForWorker($worker);

        return $bonuses->sum(function ($bonus) use ($adjustedBaseSalary, $workedDays, $worker) {
            if ($bonus->type === 'fijo') {
                return $bonus->amount ?? 0;
            } else {
                // Calcular bonificaciones variables según la función
                switch ($bonus->name_function) {
                    case 'transport_bonus':
                        return round($adjustedBaseSalary * 0.05, 2); // 5% del salario base
                    case 'food_bonus':
                        return round($workedDays * 10, 2); // $10 por día trabajado
                    case 'seniority_bonus':
                        $seniority = $worker->seniority['years'] ?? 0;
                        return round($adjustedBaseSalary * ($seniority * 0.02), 2); // 2% por año
                    default:
                        return $bonus->amount ?? 0;
                }
            }
        });
    }
}
