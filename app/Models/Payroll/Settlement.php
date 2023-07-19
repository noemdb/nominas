<?php

namespace App\Models\Payroll;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id','date','gross_salary','net_salary','tax_deductions','other_deductions','total_deductions','total_additions','total_pay'
    ];

    protected $dates = ['date'];

    const COLUMN_COMMENTS = [
        'employee_id'=>'Empleado',
        'date'=>'Fecha',
        'gross_salary'=>'Salario bruto',
        'net_salary'=>'El salario neto',
        'tax_deductions'=>'Deducciones fiscales',
        'other_deductions'=>'Otras deducciones',
        'total_deductions'=>'Total de deducciones',
        'total_additions'=>'Total de adiciones a la nómina',
        'total_pay'=>'Total',
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
'employee_id','date','gross_salary','net_salary','tax_deductions','other_deductions','total_deductions','total_additions','total_pay'

employee_id
date
gross_salary
net_salary
tax_deductions
other_deductions
total_deductions
total_additions
total_pay

*/
