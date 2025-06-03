<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class PayrollWorkerDeduction extends Model
{
    use HasFactory;

    protected $fillable = [
        'payroll_worker_detail_id',
        'deduction_id',
        'amount',
        'status_active'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'status_active' => 'boolean',
    ];

    /**
     * Get the payroll worker detail that owns the deduction.
     */
    public function payrollWorkerDetail()
    {
        return $this->belongsTo(PayrollWorkerDetail::class);
    }

    /**
     * Get the deduction that owns the payroll worker deduction.
     */
    public function deduction()
    {
        return $this->belongsTo(Deduction::class);
    }

    /**
     * Scope a query to only include active deductions.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status_active', true);
    }

    /**
     * Scope a query to only include inactive deductions.
     */
    public function scopeInactive(Builder $query): Builder
    {
        return $query->where('status_active', false);
    }

    /**
     * Scope a query to filter by deduction type.
     */
    public function scopeOfType(Builder $query, string $type): Builder
    {
        return $query->whereHas('deduction', function ($q) use ($type) {
            $q->where('type', $type);
        });
    }

    /**
     * Scope a query to filter by deduction function.
     */
    public function scopeOfFunction(Builder $query, string $function): Builder
    {
        return $query->whereHas('deduction', function ($q) use ($function) {
            $q->where('name_function', $function);
        });
    }

    /**
     * Scope a query to filter by deduction amount range.
     */
    public function scopeAmountBetween(Builder $query, float $min, float $max): Builder
    {
        return $query->whereBetween('amount', [$min, $max]);
    }

    /**
     * Get the worker associated with this deduction through the payroll worker detail.
     */
    public function worker()
    {
        return $this->hasOneThrough(
            Worker::class,
            PayrollWorkerDetail::class,
            'id', // Foreign key on payroll_worker_details table
            'id', // Foreign key on workers table
            'payroll_worker_detail_id', // Local key on payroll_worker_deductions table
            'worker_id' // Local key on payroll_worker_details table
        );
    }

    /**
     * Get the payroll associated with this deduction through the payroll worker detail.
     */
    public function payroll()
    {
        return $this->hasOneThrough(
            Payroll::class,
            PayrollWorkerDetail::class,
            'id', // Foreign key on payroll_worker_details table
            'id', // Foreign key on payrolls table
            'payroll_worker_detail_id', // Local key on payroll_worker_deductions table
            'payroll_id' // Local key on payroll_worker_details table
        );
    }

    /**
     * Get the deduction name.
     */
    public function getDeductionNameAttribute(): ?string
    {
        return $this->deduction?->name;
    }

    /**
     * Get the deduction type.
     */
    public function getDeductionTypeAttribute(): ?string
    {
        return $this->deduction?->type;
    }

    /**
     * Get the deduction function name.
     */
    public function getDeductionFunctionAttribute(): ?string
    {
        return $this->deduction?->name_function;
    }

    /**
     * Get the worker name.
     */
    public function getWorkerNameAttribute(): ?string
    {
        return $this->worker?->full_name;
    }

    /**
     * Get the payroll name.
     */
    public function getPayrollNameAttribute(): ?string
    {
        return $this->payroll?->name;
    }

    /**
     * Get the formatted amount with currency symbol.
     */
    public function getFormattedAmountAttribute(): string
    {
        return '$' . number_format($this->amount, 2);
    }

    /**
     * Get the status label.
     */
    public function getStatusLabelAttribute(): string
    {
        return $this->status_active ? 'Activo' : 'Inactivo';
    }

    /**
     * Get the status color for UI display.
     */
    public function getStatusColorAttribute(): string
    {
        return $this->status_active ? 'green' : 'red';
    }

    /**
     * Get all active deductions for a specific payroll worker detail.
     */
    public static function getActiveDeductionsForDetail(int $payrollWorkerDetailId): \Illuminate\Database\Eloquent\Collection
    {
        return self::with(['deduction', 'worker'])
            ->where('payroll_worker_detail_id', $payrollWorkerDetailId)
            ->where('status_active', true)
            ->get();
    }

    /**
     * Get the total amount of active deductions for a specific payroll worker detail.
     */
    public static function getTotalActiveDeductionsForDetail(int $payrollWorkerDetailId): float
    {
        return self::where('payroll_worker_detail_id', $payrollWorkerDetailId)
            ->where('status_active', true)
            ->sum('amount');
    }

    /**
     * Get all deductions grouped by type for a specific payroll worker detail.
     */
    public static function getDeductionsByTypeForDetail(int $payrollWorkerDetailId): \Illuminate\Support\Collection
    {
        return self::with('deduction')
            ->where('payroll_worker_detail_id', $payrollWorkerDetailId)
            ->get()
            ->groupBy(function ($item) {
                return $item->deduction->type ?? 'unknown';
            });
    }

    /**
     * Get all deductions grouped by function for a specific payroll worker detail.
     */
    public static function getDeductionsByFunctionForDetail(int $payrollWorkerDetailId): \Illuminate\Support\Collection
    {
        return self::with('deduction')
            ->where('payroll_worker_detail_id', $payrollWorkerDetailId)
            ->get()
            ->groupBy(function ($item) {
                return $item->deduction->name_function ?? 'unknown';
            });
    }

    /**
     * Get deductions by institution for a specific payroll worker detail.
     */
    public static function getDeductionsByInstitutionForDetail(int $payrollWorkerDetailId): \Illuminate\Support\Collection
    {
        return self::with(['deduction' => function ($query) {
            $query->with('institution');
        }])
            ->where('payroll_worker_detail_id', $payrollWorkerDetailId)
            ->get()
            ->groupBy(function ($item) {
                return $item->deduction->institution->name ?? 'Sin institución';
            });
    }

    /**
     * Get deductions by area for a specific payroll worker detail.
     */
    public static function getDeductionsByAreaForDetail(int $payrollWorkerDetailId): \Illuminate\Support\Collection
    {
        return self::with(['deduction' => function ($query) {
            $query->with('area');
        }])
            ->where('payroll_worker_detail_id', $payrollWorkerDetailId)
            ->get()
            ->groupBy(function ($item) {
                return $item->deduction->area->name ?? 'Sin área';
            });
    }

    /**
     * Get deductions by worker for a specific payroll worker detail.
     */
    public static function getDeductionsByWorkerForDetail(int $payrollWorkerDetailId): \Illuminate\Support\Collection
    {
        return self::with(['deduction' => function ($query) {
            $query->with('worker');
        }])
            ->where('payroll_worker_detail_id', $payrollWorkerDetailId)
            ->get()
            ->groupBy(function ($item) {
                return $item->deduction->worker->full_name ?? 'Sin trabajador';
            });
    }
}
