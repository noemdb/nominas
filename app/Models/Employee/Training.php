<?php

namespace App\Models\Employee;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id','name','description','provider','start','end','location','duration_hours','certificate_number','certificate_issue','certificate_expiration',
    ];

    // protected $dates = ['start','end'];

    const COLUMN_COMMENTS = [
        'employee_id'=>'Empleado',
        'name'=>'Nombre',
        'description'=>'Descripción',
        'provider'=>'Proveedor',
        'start'=>'Fecha de inicio',
        'end'=>'Fecha de finalización',
        'location'=>'Ubicación',
        'duration_hours'=>'Duración en horas',
        'certificate_number'=>'El número de certificado, si es aplicable',
        'certificate_issue'=>'Fecha de emisión, si es aplicable',
        'certificate_expiration'=>'La fecha de caducidad, si es aplicable',
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
'employee_id','name','description','provider','start','end','location','duration_hours','certificate_number','certificate_issue','certificate_expiration',

employee_id
name
description
provider
start
end
location
duration_hours
certificate_number
certificate_issue
certificate_expiration

*/
