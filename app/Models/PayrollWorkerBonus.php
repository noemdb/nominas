<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class PayrollWorkerBonus extends Model
{
    use HasFactory;

    protected $fillable = [
        'payroll_worker_detail_id',
        'bonus_id',
        'amount',
        'status_active'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'status_active' => 'boolean',
    ];

    /**
     * Get the payroll worker detail that owns the bonus.
     */
    public function payrollWorkerDetail()
    {
        return $this->belongsTo(PayrollWorkerDetail::class);
    }

    /**
     * Get the bonus that owns the payroll worker bonus.
     */
    public function bonus()
    {
        return $this->belongsTo(Bonus::class);
    }

    /**
     * Scope a query to only include active bonuses.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status_active', true);
    }

    /**
     * Scope a query to only include inactive bonuses.
     */
    public function scopeInactive(Builder $query): Builder
    {
        return $query->where('status_active', false);
    }

    /**
     * Scope a query to filter by bonus type.
     */
    public function scopeOfType(Builder $query, string $type): Builder
    {
        return $query->whereHas('bonus', function ($q) use ($type) {
            $q->where('type', $type);
        });
    }

    /**
     * Scope a query to filter by bonus function.
     */
    public function scopeOfFunction(Builder $query, string $function): Builder
    {
        return $query->whereHas('bonus', function ($q) use ($function) {
            $q->where('name_function', $function);
        });
    }

    /**
     * Scope a query to filter by bonus amount range.
     */
    public function scopeAmountBetween(Builder $query, float $min, float $max): Builder
    {
        return $query->whereBetween('amount', [$min, $max]);
    }

    /**
     * Get the worker associated with this bonus through the payroll worker detail.
     */
    public function worker()
    {
        return $this->hasOneThrough(
            Worker::class,
            PayrollWorkerDetail::class,
            'id', // Foreign key on payroll_worker_details table
            'id', // Foreign key on workers table
            'payroll_worker_detail_id', // Local key on payroll_worker_bonuses table
            'worker_id' // Local key on payroll_worker_details table
        );
    }

    /**
     * Get the payroll associated with this bonus through the payroll worker detail.
     */
    public function payroll()
    {
        return $this->hasOneThrough(
            Payroll::class,
            PayrollWorkerDetail::class,
            'id', // Foreign key on payroll_worker_details table
            'id', // Foreign key on payrolls table
            'payroll_worker_detail_id', // Local key on payroll_worker_bonuses table
            'payroll_id' // Local key on payroll_worker_details table
        );
    }

    /**
     * Get the bonus name.
     */
    public function getBonusNameAttribute(): ?string
    {
        return $this->bonus?->name;
    }

    /**
     * Get the bonus type.
     */
    public function getBonusTypeAttribute(): ?string
    {
        return $this->bonus?->type;
    }

    /**
     * Get the bonus function name.
     */
    public function getBonusFunctionAttribute(): ?string
    {
        return $this->bonus?->name_function;
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
     * Get all active bonuses for a specific payroll worker detail.
     */
    public static function getActiveBonusesForDetail(int $payrollWorkerDetailId): \Illuminate\Database\Eloquent\Collection
    {
        return self::with(['bonus', 'worker'])
            ->where('payroll_worker_detail_id', $payrollWorkerDetailId)
            ->where('status_active', true)
            ->get();
    }

    /**
     * Get the total amount of active bonuses for a specific payroll worker detail.
     */
    public static function getTotalActiveBonusesForDetail(int $payrollWorkerDetailId): float
    {
        return self::where('payroll_worker_detail_id', $payrollWorkerDetailId)
            ->where('status_active', true)
            ->sum('amount');
    }

    /**
     * Get all bonuses grouped by type for a specific payroll worker detail.
     */
    public static function getBonusesByTypeForDetail(int $payrollWorkerDetailId): \Illuminate\Support\Collection
    {
        return self::with('bonus')
            ->where('payroll_worker_detail_id', $payrollWorkerDetailId)
            ->get()
            ->groupBy(function ($item) {
                return $item->bonus->type ?? 'unknown';
            });
    }

    /**
     * Get all bonuses grouped by function for a specific payroll worker detail.
     */
    public static function getBonusesByFunctionForDetail(int $payrollWorkerDetailId): \Illuminate\Support\Collection
    {
        return self::with('bonus')
            ->where('payroll_worker_detail_id', $payrollWorkerDetailId)
            ->get()
            ->groupBy(function ($item) {
                return $item->bonus->name_function ?? 'unknown';
            });
    }
}
