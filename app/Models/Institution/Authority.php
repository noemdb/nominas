<?php

namespace App\Models\Institution;

use App\Models\Institution;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authority extends Model
{
    use HasFactory;

    protected $fillable = [
        'institution_id', 'name','ci', 'position', 'email', 'phone_number', 'address', 'profile_professional', 'finicial', 'ffinal', 'photo'
    ];

    protected $dates = ['finicial','ffinal'];

    use HasFactory;

    const COLUMN_COMMENTS = [
        'institution_id'=>'Institución',
        'name'=>'Nombre completo',
        'ci'=>'N.Identificación',
        'position'=>'Cargo',
        'email'=>'Dir. de correo electrónico',
        'phone_number'=>'número de teléfono',
        'address'=>'Dirección',
        'profile_professional'=>'Perfíl profesional',
        'finicial'=>'F.Inicial',
        'ffinal'=>'F.Final',
        'photo'=>'Imagen',
    ];

    public static function list_position() /* usada para llenar los objetos de formularios select*/
    {
        return ['Director','Administrador','Gerente','Coordinador'];
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public static function list_institution() /* usada para llenar los objetos de formularios select*/
    {
        return Institution::pluck('name', 'id');
    }
}

/*
, 'institution_id', 'name', 'position', 'email', 'phone_number', 'address', 'photo'
, 'profile_professional', 'finicial', 'ffinal'

institution_id
name
position
email
phone_number
address
'profile_professional'
'finicial'
'ffinal'
photo


*/
