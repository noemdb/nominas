<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payroll;

class Deduction extends Model
{
    use HasFactory;

    protected $casts = [
        'amount' => 'decimal:2',
        'percentage' => 'decimal:2',
        'status_exchange' => 'boolean',
        'status_active' => 'boolean',
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

    /**
     * Funciones disponibles para las deducciones variables
     */
    const FUNCTIONS = [
        [
            'label' => 'Por Defecto',
            'value' => 'default',
            'description' => 'Cálculo estándar basado en un porcentaje'
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

    /**
     * Get the payrolls that the deduction belongs to.
     */
    public function payrolls()
    {
        return $this->belongsToMany(Payroll::class, 'payroll_deduction');
    }

    /**
     * Check if the deduction is used in any payroll.
     */
    public function isUsedInPayroll()
    {
        return $this->payrolls()->exists();
    }
}
