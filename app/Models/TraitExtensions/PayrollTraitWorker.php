<?php

namespace App\Models\TraitExtensions;

use App\Models\WorkerBehavior;

trait PayrollTraitWorker
{
    /**
     * Los comportamientos de trabajadores asociados a la nómina
     */
    public function workerBehaviors()
    {
        return $this->belongsToMany(WorkerBehavior::class, 'payroll_worker_behavior')
            ->withPivot(['bonus_amount', 'discount_amount', 'status_active'])
            ->withTimestamps();
    }

    /**
     * Obtiene los comportamientos de trabajadores activos de la nómina
     */
    public function activeWorkerBehaviors()
    {
        return $this->workerBehaviors()->wherePivot('status_active', true);
    }

    /**
     * Obtiene los comportamientos de trabajadores por institución
     */
    public function institutionWorkerBehaviors()
    {
        return $this->workerBehaviors()->whereHas('worker', function ($query) {
            $query->whereNotNull('institution_id');
        });
    }

    /**
     * Obtiene los comportamientos de trabajadores por área
     */
    public function areaWorkerBehaviors()
    {
        return $this->workerBehaviors()->whereHas('worker', function ($query) {
            $query->whereNotNull('area_id');
        });
    }

    /**
     * Obtiene los comportamientos de trabajadores por rol
     */
    public function rolWorkerBehaviors()
    {
        return $this->workerBehaviors()->whereHas('worker', function ($query) {
            $query->whereNotNull('rol_id');
        });
    }

    /**
     * Obtiene los comportamientos de trabajadores por trabajador específico
     */
    public function workerBehaviorsByWorker($workerId)
    {
        return $this->workerBehaviors()->where('worker_id', $workerId);
    }

    /**
     * Verifica si la nómina tiene comportamientos de trabajadores asociados
     *
     * @return bool
     */
    public function hasWorkerBehaviors(): bool
    {
        return $this->workerBehaviors()->exists();
    }

    /**
     * Verifica si la nómina tiene comportamientos de trabajadores activos
     *
     * @return bool
     */
    public function hasActiveWorkerBehaviors(): bool
    {
        return $this->activeWorkerBehaviors()->exists();
    }
}