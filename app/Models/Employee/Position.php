<?php

namespace App\Models\Employee;

use App\Models\Employee;
use App\Models\Institution\Area;
use App\Models\Institution\Rol;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id','area_id','rol_id','name','description','contract_type','start','end','start_salary','frequency_workday','workday','status'
    ];

    protected $dates = ['start','end','start_salary'];

    const COLUMN_COMMENTS = [
        'employee_id'=>'Empleado',
        'area_id'=>'Área',
        'rol_id'=>'Rol',
        'name'=>'Nombre',
        'description'=>'Descripción',
        'contract_type'=>'Tipo de contrato',
        'start'=>'Fecha de inicio',
        'end'=>'Fecha de finalización',
        'start_salary'=>'Fecha de inicio de la contratación',
        'frequency_workday'=>'Frecuencia de la jornada laboral',
        'workday'=>'Jornada laboral',
        'status'=>'Activo/Inactivo',
        //--------------------------------------------
        'lapse'=>'Lapso',
        'position_name'=>'Posición',
        'employee_name'=>'Empleado',
        'area_name'=>'Área',
        'rol_name'=>'Rol',
    ];
    ////////////////////////////////////////////////////////////////////////////////////////

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class);
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
    public function getAreaNameAttribute()
    {
        return ($this->area) ? $this->area->name : null ;
    }
    public function getRolNameAttribute()
    {
        return ($this->rol) ? $this->rol->name : null ;
    }
    public function getLapseAttribute()
    {
        $start = ($this->start) ? $this->start->format('d-m-Y'): null;
        $end = ($this->end) ? $this->start->format('d-m-Y'): null;
        return $start .' | '. $end ;
    }
    ////////////////////////////////////////////////////////////////////////////////////////


    public function getStatusDeleteAttribute()
    {
        return true;
    }

    public static function list_frequency_workday() /* usada para llenar los objetos de formularios select*/
    {
        return ['Mensual','Quincenal','Semanal','Diario','Trimestral','Cuatrimestral','Semestral','Otro'];
    }

    public static function list_contract_type() /* usada para llenar los objetos de formularios select*/
    {
        return ['Temporal', 'Indefinido', 'Por obra', 'Servicio'];
    }


}


/*

'employee_id','area_id','rol_id','name','description','start','end','frequency_workday','workday','status'

*/
