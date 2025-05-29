<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    /**
     * Funciones disponibles para descuentos variables
     */
    const FUNCTIONS = [
        [
            'label' => 'Por Defecto',
            'value' => 'default',
            'description' => 'Cálculo estándar basado en el porcentaje'
        ],
        [
            'label' => 'Por Días Trabajados',
            'value' => 'by_worked_days',
            'description' => 'Cálculo basado en días trabajados del mes'
        ],
        [
            'label' => 'Por Faltas',
            'value' => 'by_absences',
            'description' => 'Cálculo basado en número de faltas'
        ],
        [
            'label' => 'Por Retardos',
            'value' => 'by_delays',
            'description' => 'Cálculo basado en número de retardos'
        ],
        [
            'label' => 'Por Permisos',
            'value' => 'by_permissions',
            'description' => 'Cálculo basado en número de permisos'
        ]
    ];

    const TYPES = [
        [
            'label' => 'Fijo',
            'value' => 'fijo',
            'description' => 'Monto fijo que se aplica independientemente de otros factores'
        ],
        [
            'label' => 'Variable',
            'value' => 'variable',
            'description' => 'Monto que varía según una función de cálculo específica'
        ]
    ];

    protected $fillable = [
        'name',
        'description',
        'institution_id',
        'area_id',
        'rol_id',
        'position_id',
        'worker_id',
        'type',
        'amount',
        'percentage',
        'name_function',
        'status_exchange',
        'status_active'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'percentage' => 'decimal:2',
        'status_exchange' => 'boolean',
        'status_active' => 'boolean',
    ];

    /**
     * Las nóminas a las que está asociado el descuento
     */
    public function payrolls()
    {
        return $this->belongsToMany(Payroll::class, 'payroll_discount')
            ->withPivot(['amount', 'status_active'])
            ->withTimestamps();
    }

    /**
     * Obtiene las nóminas activas donde está aplicado el descuento
     */
    public function activePayrolls()
    {
        return $this->payrolls()->wherePivot('status_active', true);
    }

    /**
     * Check if the discount is used in any payroll.
     */
    public function isUsedInPayroll()
    {
        return $this->payrolls()->exists();
    }

    /**
     * Scope para filtrar descuentos por tipo
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope para filtrar descuentos fijos
     */
    public function scopeFixed($query)
    {
        return $query->where('type', 'fijo');
    }

    /**
     * Scope para filtrar descuentos variables
     */
    public function scopeVariable($query)
    {
        return $query->where('type', 'variable');
    }

    /**
     * Scope para filtrar descuentos por ámbito
     */
    public function scopeByScope($query, $scope)
    {
        return $query->whereNotNull($scope . '_id');
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    /**
     * Obtiene el nombre de la institución
     */
    public function getInstitutionNameAttribute()
    {
        return $this->institution ? $this->institution->name : null;
    }

    /**
     * Obtiene el nombre del área
     */
    public function getAreaNameAttribute()
    {
        return $this->area ? $this->area->name : null;
    }

    /**
     * Obtiene el nombre del rol
     */
    public function getRolNameAttribute()
    {
        return $this->rol ? $this->rol->name : null;
    }

    /**
     * Obtiene el nombre del trabajador
     */
    public function getWorkerNameAttribute()
    {
        return $this->worker ? $this->worker->full_name : null;
    }
}
