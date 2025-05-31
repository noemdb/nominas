<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WeeklyWorkSchedule extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'position_id',
        'day_of_week',
        'planned_hours',
        'is_active',
        'observations',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'planned_hours' => 'decimal:2',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        // 'day_of_week' => 'float',
    ];

    /**
     * The days of the week constants
     */
    const DAYS_OF_WEEK = [
        'Monday' => 'Lunes',
        'Tuesday' => 'Martes',
        'Wednesday' => 'Miércoles',
        'Thursday' => 'Jueves',
        'Friday' => 'Viernes',
        'Saturday' => 'Sábado',
        'Sunday' => 'Domingo',
    ];

    /**
     * Validation rules for the model
     *
     * @var array<string, mixed>
     */
    public static $rules = [
        'position_id' => 'required|exists:positions,id',
        'day_of_week' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
        'planned_hours' => 'required|numeric|min:0|max:24',
        'is_active' => 'boolean',
        'observations' => 'nullable|string|max:1000',
    ];

    /**
     * Get the position that owns the schedule.
     */
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    /**
     * Get the total planned hours for a position in a week
     *
     * @param int $positionId
     * @return float
     */
    public static function getTotalWeeklyHours(int $positionId): float
    {
        return self::where('position_id', $positionId)
            ->where('is_active', true)
            ->sum('planned_hours');
    }

    /**
     * Get the schedule for a specific position
     *
     * @param int $positionId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getPositionSchedule(int $positionId)
    {
        return self::where('position_id', $positionId)
            ->where('is_active', true)
            ->orderByRaw("FIELD(day_of_week, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')")
            ->get();
    }

    /**
     * Get the Spanish name for the day of week
     *
     * @return string
     */
    public function getDayNameInSpanish(): string
    {
        return self::DAYS_OF_WEEK[$this->day_of_week] ?? $this->day_of_week;
    }

    /**
     * Scope a query to only include active schedules
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include schedules for a specific position
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $positionId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForPosition($query, int $positionId)
    {
        return $query->where('position_id', $positionId);
    }

    /**
     * Check if the schedule is valid (total hours per week <= 40)
     *
     * @return bool
     */
    public function isValidSchedule(): bool
    {
        $totalHours = self::getTotalWeeklyHours($this->position_id);
        return $totalHours <= 50; // por defecto 40 horas
    }

    /**
     * Get the monthly estimated hours (weekly hours * 4.33)
     *
     * @return float
     */
    public static function getMonthlyEstimatedHours(int $positionId): float
    {
        $weeklyHours = self::getTotalWeeklyHours($positionId);
        return round($weeklyHours * 4.33, 2);
    }
}
