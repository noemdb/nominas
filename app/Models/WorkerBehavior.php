<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkerBehavior extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'worker_id',
        'date',
        'attendance_days',
        'absences',
        'permissions',
        'delays',
        'observations',
        'bonus',
        'discount',
        'status',
        'approved_by',
        'approved_at'
    ];

    protected $casts = [
        'date' => 'date',
        'attendance_days' => 'integer',
        'absences' => 'integer',
        'permissions' => 'integer',
        'delays' => 'integer',
        'bonus' => 'decimal:2',
        'discount' => 'decimal:2',
        'approved_at' => 'datetime'
    ];

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function histories()
    {
        return $this->hasMany(WorkerBehaviorHistory::class);
    }

    /**
     * Las nóminas asociadas a este comportamiento
     */
    public function payrolls()
    {
        return $this->belongsToMany(Payroll::class, 'payroll_worker_behavior')
            ->withPivot(['bonus_amount', 'discount_amount', 'status_active'])
            ->withTimestamps();
    }

    /**
     * Check if the behavior is used in any payroll.
     */
    public function isUsedInPayroll()
    {
        return $this->payrolls()->exists();
    }
}
