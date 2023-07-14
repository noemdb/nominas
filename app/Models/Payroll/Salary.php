<?php

namespace App\Models\Payroll;

use App\Models\Employee;
use App\Models\Institution\Currency;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'employee_id','currency_id','date','amount','payment_status'
        // 'employee_id','date','frequency','amount','payment_status'
        'employee_id','frequency','amount'
    ];

    protected $dates = ['start','end'];

    const COLUMN_COMMENTS = [
        'employee_id'=>'Empleado',
        // 'currency_id'=>'Moneda',
        // 'date'=>'Fecha',
        'amount'=>'Monto',
        'frequency'=>'Frecuencia',
        // 'payment_status'=>'Estado del pago',
        //--------------------------------------------
        'employee_name'=>'Empleado',
    ];
    ////////////////////////////////////////////////////////////////////////////////////////

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function currency()
    {
        return $this->belongsTo(Currency::class);
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

    public static function list_payment_status() /* usada para llenar los objetos de formularios select*/
    {
        return ['Pagado','Pendiente','Cancelado','Retenido','En revisión'];
    }

    public static function list_frequency() /* usada para llenar los objetos de formularios select*/
    {
        return ['Mensual','Quincenal','Semanal','Diario','Por horas'];
    }
}


/*
'employee_id','currency_id','date','amount','payment_status'

employee_id
currency_id
date
amount
payment_status

*/
