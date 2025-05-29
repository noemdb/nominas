<?php

namespace App\Models\TraitExtensions;

use App\Models\Bonus;

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
}
