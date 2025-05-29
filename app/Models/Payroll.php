<?php

namespace App\Models;

use App\Models\TraitExtensions\PayrollTraitDiscount;
use App\Models\TraitExtensions\PayrollTraitDeduction;
use App\Models\TraitExtensions\PayrollTraitBonus;
use App\Models\TraitExtensions\PayrollTraitWorker;
use App\Models\TraitExtensions\PayrollTraitManage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Payroll extends Model
{
    use HasFactory,
        PayrollTraitDiscount,
        PayrollTraitDeduction,
        PayrollTraitBonus,
        PayrollTraitWorker,
        PayrollTraitManage;

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
     * Get the formatted status of the payroll.
     *
     * @return array{label: string, color: string, value: string}
     */
    public function getStatusAttribute()
    {
        if (!$this->status_active) {
            return [
                'label' => 'Inactivo',
                'color' => 'red',
                'value' => 'inactive'
            ];
        }

        if ($this->status_approved) {
            return [
                'label' => 'Aprobado',
                'color' => 'green',
                'value' => 'approved'
            ];
        }

        if ($this->status_public) {
            return [
                'label' => 'Publicado',
                'color' => 'blue',
                'value' => 'public'
            ];
        }

        return [
            'label' => 'En Proceso',
            'color' => 'yellow',
            'value' => 'in_progress'
        ];
    }

    /**
     * Get the period start date.
     *
     * @return \Carbon\Carbon|null
     */
    public function getPeriodStartAttribute()
    {
        return $this->date_start ? Carbon::parse($this->date_start) : null;
    }

    /**
     * Get the period end date.
     *
     * @return \Carbon\Carbon|null
     */
    public function getPeriodEndAttribute()
    {
        return $this->date_end ? Carbon::parse($this->date_end) : null;
    }

    public function scopeSearch($query, $search)
    {
        return $query->when($search, function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhere('observations', 'like', '%' . $search . '%');
        });
    }

    /**
     * Get payrolls formatted for select options.
     *
     * @return array
     */
    public static function getSelectOptions()
    {
        return self::orderBy('name')->get()->map(function ($payroll) {
            return [
                'value' => $payroll->id,
                'label' => $payroll->name,
            ];
        })->toArray();
    }
}
