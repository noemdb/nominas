<?php

namespace App\Models\Employee;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id','address','city','state','zip_code','country','phone_number','home_phone','emergency_contact_name','emergency_contact_relationship','emergency_contact_phone','emergency_contact_email','other_details',
    ];

    const COLUMN_COMMENTS = [
        'employee_id'=>'Empleado',
        'employee_name'=>'Nombre',
        'employee_ci'=>'Ident. Empleado',
        'address'=>'Dirección',
        'city'=>'Ciudad',
        'state'=>'Estado o provincia',
        'zip_code'=>'Código postal',
        'country'=>'País',
        'phone_number'=>'N.Teléfono',
        'home_phone'=>'N.Teléfono del hogar',
        'emergency_contact_name'=>'El nombre de la persona de contacto de emergencia',
        'emergency_contact_relationship'=>'La relación de la persona de contacto de emergencia con el empleado',
        'emergency_contact_phone'=>'El número de teléfono de la persona de contacto de emergencia',
        'emergency_contact_email'=>'La dirección de correo electrónico de la persona de contacto de emergencia',
        'disability'=>'Discapacidad',
        'other_details'=>'Cualquier otra información personal relevante',
    ];

    /* 'employee_name','employee_ci','address','other_details' */

    public function getEmployeeNameAttribute()
    {
        return ($this->employee) ? $this->employee->name : null ;
    }

    public function getEmployeeCiAttribute()
    {
        return ($this->employee) ? $this->employee->ci : null ;
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function getStatusDeleteAttribute()
    {
        return true;
    }

    public static function list_relationship() /* usada para llenar los objetos de formularios select*/
    {
        return ['Esposo(a)','Hermano(a)','Padre','Madre','Otro'];
    }

    public static function list_disability() /* usada para llenar los objetos de formularios select*/
    {
        return ['Visual','Auditiva','Motora','Intelectual','Psicosocial'];
    }
}
/*

'employee_id','address','city','state','zip_code','country','phone_number','home_phone','emergency_contact_name','emergency_contact_relationship','emergency_contact_phone','emergency_contact_email','other_details',

employee_id
address
city
state
zip_code
country
phone_number
home_phone
emergency_contact_name
emergency_contact_relationship
emergency_contact_phone
emergency_contact_email
other_details

*/
