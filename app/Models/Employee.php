<?php

namespace App\Models;

use App\Models\Employee\Position;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'institution_id','name','ci','hire_date','termination_date','status','email'
    ];

    const COLUMN_COMMENTS = [
        'institution_id'=>'Institución',
        'institution_name'=>'Institución',
        'name'=>'Nombre completo',
        'ci'=>'N.Identificación',
        'hire_date'=>'Fecha de contratación',
        'termination_date'=>'Fecha de finalalización',
        'status'=>'Estado actual',
        'email'=>'Dirección de correo electrónico',
        'position'=>'Cargo',
    ];

    public function getInstitutionNameAttribute()
    {
        return ($this->institution) ? $this->institution->name : null ;
    }

    public function positions()
    {
        return $this->hasMany(Position::class);
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public static function list_employee() /* usada para llenar los objetos de formularios select*/
    {
        return Employee::pluck('name', 'id');
    }

    public static function list_status() /* usada para llenar los objetos de formularios select*/
    {
        return ['active', 'inactive', 'on leave'];
    }

    public function getStatusDeleteAttribute()
    {
        // return $this->positions->isEmpty();
        return true;
    }
}

/*
'institution_id','hire_date','termination_date','status','email'

institution_id
hire_date
termination_date
status
email
*/
