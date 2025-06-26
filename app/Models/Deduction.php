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
            'label' => 'Seguro Social Obligatorio',
            'value' => 'sso_v1',
            'description' => 'Descuento legal destinado al sistema de salud y seguridad social del país',
            'example' => '<strong>SSO</strong> = <em>Salario Mensual</em> × <em>Tasa SSO (Ej: 4%)</em>'
        ],
        [
            'label' => 'Régimen Prestacional de Empleo (Paro forzoso)',
            'value' => 'forced_unemployment',
            'description' => 'Aporte al fondo que respalda al trabajador en caso de desempleo.',
            'example' => '<strong>Paro Forzoso</strong> = <em>Salario Mensual</em> × <em>Tasa Paro (Ej: 0.5%)</em>'
        ],
        [
            'label' => 'FAOV. Fondo de Ahorro para la Vivienda',
            'value' => 'faov_v1',
            'description' => 'Aporte destinado al financiamiento habitacional del trabajador.',
            'example' => '<strong>FAOV</strong> = <em>Salario Mensual</em> × <em>Tasa FAOV (Ej: 1%)</em>'
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

    /**
     * Calcula el monto de la deducción basado en el salario base.
     *
     * @param float $baseSalary Salario mensual base del trabajador.
     * @return float Monto calculado de la deducción.
     */

    public function calculateAmount(int $workerId): float
    {
        // Obtener el trabajador con su posición actual cargada
        $worker = Worker::with('current_position')->find($workerId);

        if (!$worker || !$worker->current_position) {
            return 0.00; // Si no existe el trabajador o no tiene posición
        }

        $baseSalary = $worker->current_position->base_salary_pos;

        if ($this->type === 'fijo') {
            // Monto fijo definido directamente en la deducción
            return round($this->amount, 2);
        }

        if ($this->type === 'variable') {
            switch ($this->name_function) {
                case 'sso_v1':
                    $rate = 0.04;
                    return round($baseSalary * $rate, 2);

                case 'forced_unemployment':
                    $rate = 0.005;
                    return round($baseSalary * $rate, 2);

                case 'faov_v1':
                    $rate = 0.01;
                    return round($baseSalary * $rate, 2);

                default:
                    return 0.00;
            }
        }

        return 0.00;
    }
}
