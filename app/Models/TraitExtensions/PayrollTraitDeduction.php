<?php

namespace App\Models\TraitExtensions;

use App\Models\Deduction;

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
}
