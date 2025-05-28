<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date_start',
        'date_end',
        'num_days',
        'description',
        'observations',
        'status_exchange',
        'status_active',
        'status_public',
        'status_approved',
    ];

    protected $casts = [
        'date_start' => 'date',
        'date_end' => 'date',
        'status_exchange' => 'boolean',
        'status_active' => 'boolean',
        'status_public' => 'boolean',
        'status_approved' => 'boolean',
    ];

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

    public function scopeSearch($query, $search)
    {
        return $query->when($search, function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhere('observations', 'like', '%' . $search . '%');
        });
    }
}