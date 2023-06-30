<?php

namespace App\Models\Employee;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialSecurity extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id','number','card_number','card_issue_date','card_expiration_date','benefits_eligibility','benefits_payment_amount',
        'benefits_payment_start_date','benefits_payment_end_date'
    ];

    // protected $dates = ['start','end'];

    const COLUMN_COMMENTS = [
        'employee_id'=>'Empleado',
        'number'=>'Núm. de segurdad social',
        'card_number'=>'Núm. de la tarjeta de seguro social, si es aplicable',
        'card_issue_date'=>'La fecha de emisión de la tarjeta de seguridad social, si es aplicable',
        'card_expiration_date'=>'La fecha de caducidad de la tarjetade seguridad social, si es aplicable',
        'benefits_eligibility'=>'La elegibilidad para los beneficios del seguro social',
        'benefits_payment_amount'=>'La cantidad de beneficios del seguro social pagados al empleado, si es aplicable',
        'benefits_payment_start_date'=>'La fecha de inicio de los pagos de beneficios del seguro social al empleado, si es aplicable',
        'benefits_payment_end_date'=>'La fecha de finalización de los pagos de beneficios del seguro social al empleado, si es aplicable',
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
}

/*
'employee_id','number','card_number','card_issue_date','card_expiration_date','benefits_eligibility','benefits_payment_amount','benefits_payment_start_date','benefits_payment_end_date'

employee_id
number
card_number
card_issue_date
card_expiration_date
benefits_eligibility
benefits_payment_amount
benefits_payment_start_date
benefits_payment_end_date

*/
