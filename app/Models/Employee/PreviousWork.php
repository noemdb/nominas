<?php

namespace App\Models\Employee;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreviousWork extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id','company_name','position','start_date','end_date','reason_for_leaving','references'
    ];

    protected $dates = ['start','end'];

    const COLUMN_COMMENTS = [
        'employee_id'=>'Empleado',
        'company_name'=>'Nombre del empleador',
        'position'=>'Cargo que ocupó',
        'start_date'=>'Fecha de inicio',
        'end_date'=>'Fecha de finalización',
        'reason_for_leaving'=>'Razón por la que el empleado dejó su trabajo anterior',
        'references'=>'Información de contacto de posibles referencias para el empleado',
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

'employee_id','company_name','position','start_date','end_date','reason_for_leaving','references'

employee_id
company_name
position
start_date
end_date
reason_for_leaving
references

*/
