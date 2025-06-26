<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payroll;

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
            'description' => 'Cálculo de bonificación para gastos de transporte basado en días trabajados',
            'example' => '<code>asignación = (salario_diario * días_trabajados) * tasa_transporte</code>'
        ],
        [
            'label' => 'Bonificación por Vestimenta',
            'value' => 'clothing_bonus',
            'description' => 'Cálculo de bonificación para gastos de vestimenta y uniformes',
            'example' => '<code>asignación = salario_mensual * tasa_vestimenta</code>'
        ],
        [
            'label' => 'Bonificación por Alimentación',
            'value' => 'food_bonus',
            'description' => 'Cálculo de bonificación para gastos de alimentación basado en días laborables',
            'example' => '<code>asignación = monto_diario_alimentación * días_trabajados</code>'
        ],
        [
            'label' => 'Bonificación por Medicina',
            'value' => 'medical_bonus',
            'description' => 'Cálculo de bonificación para gastos médicos y seguro de salud',
            'example' => '<code>asignación = salario_mensual * tasa_medicina</code>'
        ],
        [
            'label' => 'Bonificación por Educación',
            'value' => 'education_bonus',
            'description' => 'Cálculo de bonificación para gastos educativos y capacitación',
            'example' => '<code>asignación = salario_mensual * tasa_educación</code>'
        ],
        [
            'label' => 'Bonificación por Antigüedad',
            'value' => 'seniority_bonus',
            'description' => 'Cálculo de bonificación basado en años de servicio en la empresa',
            'example' => '<code>asignación = salario_mensual * (tasa_antigüedad * años_servicio)</code>'
        ],
        [
            'label' => 'Bonificación por Productividad',
            'value' => 'productivity_bonus',
            'description' => 'Cálculo de bonificación basado en metas y objetivos alcanzados',
            'example' => '<code>asignación = salario_mensual * tasa_productividad</code>'
        ],
        [
            'label' => 'Bonificación por Asistencia',
            'value' => 'attendance_bonus',
            'description' => 'Cálculo de bonificación por asistencia perfecta y puntualidad',
            'example' => '<code>asignación = salario_mensual * tasa_asistencia</code>'
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
        ],
        [
            'label' => 'Prima de jerarquía',
            'value' => 'hierarchy_bonus',
            'description' => 'Cálculo de prima jerárquica según el cargo.'
        ],
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
     * Get the payrolls that the bonus belongs to.
     */
    public function payrolls()
    {
        return $this->belongsToMany(Payroll::class, 'payroll_bonus');
    }

    /**
     * Check if the bonus is used in any payroll.
     */
    public function isUsedInPayroll()
    {
        // Assuming a 'payroll_bonus' table exists and links bonuses to payrolls
        // You might need to adjust the table name or logic based on your actual database structure
        return $this->payrolls()->exists();
    }

    /**
     * Calcula el monto del bono basado en el tipo y función.
     *
     * @param float $baseSalary Salario mensual base del trabajador.
     * @param array $context Parámetros adicionales (como días trabajados, años de antigüedad, etc.).
     * @return float Monto calculado del bono.
     */

    public function calculateAmount(int $workerId): float
    {
        // Obtener al trabajador con la posición actual
        $worker = Worker::with('current_position')->find($workerId);

        if (!$worker || !$worker->current_position) {
            return 0.00;
        }

        $baseSalary = $worker->current_position->base_salary_pos;

        if ($this->type === 'fijo') {
            return round($this->amount, 2);
        }

        if ($this->type === 'variable') {
            switch ($this->name_function) {
                case 'transport_bonus':
                    $daysWorked = $worker->days_worked ?? 0; // Asegúrate de definir esta propiedad en tu modelo o cálculo
                    $dailyTransportRate = 2.00;
                    return round($dailyTransportRate * $daysWorked, 2);

                case 'clothing_bonus':
                    return round($baseSalary * 0.02, 2);

                case 'food_bonus':
                    $daysWorked = $worker->days_worked ?? 0;
                    $dailyFoodRate = 3.50;
                    return round($dailyFoodRate * $daysWorked, 2);

                case 'medical_bonus':
                    return round($baseSalary * 0.015, 2);

                case 'education_bonus':
                    return round($baseSalary * 0.01, 2);

                case 'seniority_bonus':
                    $years = $worker->years_of_service ?? 0; // Este dato deberías calcularlo o almacenarlo
                    return round($baseSalary * 0.05 * $years, 2);

                case 'productivity_bonus':
                    $score = $worker->productivity_score ?? 0;
                    return round($score * 10.00, 2);

                case 'attendance_bonus':
                    $perfectAttendance = $worker->perfect_attendance ?? false;
                    return $perfectAttendance ? round($baseSalary * 0.03, 2) : 0.00;

                case 'hierarchy_bonus':
                    return round($baseSalary * 0.10, 2);

                default:
                    return 0.00;
            }
        }

        return 0.00;
    }
}
