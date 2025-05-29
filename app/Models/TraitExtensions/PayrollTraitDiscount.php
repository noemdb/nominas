<?php

namespace App\Models\TraitExtensions;

use App\Models\Discount;

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
}
