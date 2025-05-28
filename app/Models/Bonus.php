<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    use HasFactory;

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
     * Funciones disponibles para descuentos variables
     */
    const FUNCTIONS = [
        [
            'label' => 'Bonificación por Transporte',
            'value' => 'transport_bonus',
            'description' => 'Cálculo de bonificación para gastos de transporte basado en días trabajados'
        ],
        [
            'label' => 'Bonificación por Vestimenta',
            'value' => 'clothing_bonus',
            'description' => 'Cálculo de bonificación para gastos de vestimenta y uniformes'
        ],
        [
            'label' => 'Bonificación por Alimentación',
            'value' => 'food_bonus',
            'description' => 'Cálculo de bonificación para gastos de alimentación basado en días laborables'
        ],
        [
            'label' => 'Bonificación por Medicina',
            'value' => 'medical_bonus',
            'description' => 'Cálculo de bonificación para gastos médicos y seguro de salud'
        ],
        [
            'label' => 'Bonificación por Educación',
            'value' => 'education_bonus',
            'description' => 'Cálculo de bonificación para gastos educativos y capacitación'
        ],
        [
            'label' => 'Bonificación por Antigüedad',
            'value' => 'seniority_bonus',
            'description' => 'Cálculo de bonificación basado en años de servicio en la empresa'
        ],
        [
            'label' => 'Bonificación por Productividad',
            'value' => 'productivity_bonus',
            'description' => 'Cálculo de bonificación basado en metas y objetivos alcanzados'
        ],
        [
            'label' => 'Bonificación por Asistencia',
            'value' => 'attendance_bonus',
            'description' => 'Cálculo de bonificación por asistencia perfecta y puntualidad'
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
