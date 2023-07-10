<?php

namespace App\Models\Payroll;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bonification extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id','type','description','amount','frequency','date'
    ];

    protected $dates = ['start','end'];

    const COLUMN_COMMENTS = [
        'employee_id'=>'Empleado',
        'type'=>'Tipo de bonificación',
        'description'=>'Descripción',
        'amount'=>'Monto',
        'frequency'=>'Frecuencia',
        'date'=>'Fecha',
        //--------------------------------------------
        'employee_name'=>'Empleado',
    ];
    ////////////////////////////////////////////////////////////////////////////////////////

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    ////////////////////////////////////////////////////////////////////////////////////////

    public function getEmployeeNameAttribute()
    {
        return ($this->employee) ? $this->employee->name : null ;
    }
    public function getEmployeeCiAttribute()
    {
        return ($this->employee) ? $this->employee->ci : null ;
    }
    public function getEmployeeFullNameAttribute()
    {
        return ($this->employee) ? $this->employee->ci.' - '.$this->employee->name : null ;
    }
    ////////////////////////////////////////////////////////////////////////////////////////


    public function getStatusDeleteAttribute()
    {
        return true;
    }

    public static function list_type() /* usada para llenar los objetos de formularios select*/
    {
        return ['Por desempeño','Por objetivo alcanzado','Por antigüedad','Otro'];
    }

    public static function list_frecuency() /* usada para llenar los objetos de formularios select*/
    {
        return ['Mensual','Quincenal','Trimestral','Semestral','Cuatrimestral'];
    }
}

/*
'employee_id','type','description','amount','frequency','date'

employee_id
type
description
amount
frequency
date

*/
