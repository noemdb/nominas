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
        'num_weeks',
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
        'num_weeks' => 'integer',
        'status_exchange' => 'boolean',
        'status_active' => 'boolean',
        'status_public' => 'boolean',
        'status_approved' => 'boolean',
    ];

    /**
     * Get the worker details for this payroll.
     */
    public function payrollWorkerDetails()
    {
        return $this->hasMany(PayrollWorkerDetail::class);
    }

    /**
     * Get the currency based on status_exchange.
     *
     * @return string
     */
    public function getCurrencyAttribute(): string
    {
        return $this->status_exchange ? 'USD' : 'Bs';
    }

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

    /**
     * Get the total number of active workers in the payroll.
     */
    public function getTotalWorkersAttribute(): int
    {
        return $this->payrollWorkerDetails()
            ->where('status_active', true)
            ->count();
    }

    /**
     * Get the total earned amount (base salary + bonuses) for the payroll.
     */
    public function getTotalEarnedAttribute(): float
    {
        return $this->payrollWorkerDetails()
            ->where('status_active', true)
            ->sum('total_assignments');
    }

    /**
     * Get the total net pay for the payroll.
     */
    public function getTotalNetPayAttribute(): float
    {
        return $this->payrollWorkerDetails()
            ->where('status_active', true)
            ->sum('net_pay');
    }

    /**
     * Get the total assignments (base salary + bonuses) for the payroll.
     */
    public function getTotalAssignmentsAttribute(): float
    {
        return $this->payrollWorkerDetails()
            ->where('status_active', true)
            ->sum('total_assignments');
    }

    /**
     * Get the total discounts for the payroll.
     */
    public function getTotalDiscountsAttribute(): float
    {
        return $this->payrollWorkerDetails()
            ->whereHas('discounts', function ($query) {
                $query->where('status_active', true);
            })
            ->withSum(['discounts' => function ($query) {
                $query->where('status_active', true);
            }], 'amount')
            ->get()
            ->sum('discounts_sum_amount');
    }

    /**
     * Get the total deductions for the payroll.
     */
    public function getTotalDeductionsAttribute(): float
    {
        return $this->payrollWorkerDetails()
            ->whereHas('deductions', function ($query) {
                $query->where('status_active', true);
            })
            ->withSum(['deductions' => function ($query) {
                $query->where('status_active', true);
            }], 'amount')
            ->get()
            ->sum('deductions_sum_amount');
    }

    /**
     * Get a summary of all payroll calculations.
     * This method uses eager loading and optimized queries to get all totals in one go.
     */
    public function getPayrollSummaryAttribute(): array
    {
        $details = $this->payrollWorkerDetails()
            ->where('status_active', true)
            ->withSum(['discounts' => function ($query) {
                $query->where('status_active', true);
            }], 'amount')
            ->withSum(['deductions' => function ($query) {
                $query->where('status_active', true);
            }], 'amount')
            ->get();

        return [
            'total_workers' => $details->count(),
            'total_earned' => $details->sum('total_assignments'),
            'total_net_pay' => $details->sum('net_pay'),
            'total_assignments' => $details->sum('total_assignments'),
            'total_discounts' => $details->sum('discounts_sum_amount'),
            'total_deductions' => $details->sum('deductions_sum_amount')
        ];
    }
}
