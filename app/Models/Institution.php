<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $fillable = [
        'name','type','acronym','address','phone_number','email','website','foundation_date','legal_status','tax_id','registration_number','logo'
    ];

    use HasFactory;

    const COLUMN_COMMENTS = [
        'name'=>'Nombre completo de la institución',
        'type'=>'Tipo de la institución',
        'acronym'=>'Acrónimo o sigla de la institución, si lo tiene',
        'address'=>'Dirección física de la institución',
        'phone_number'=>'Número de teléfono de la institución',
        'email'=>'Dirección de correo electrónico de la institución',
        'website'=>'Dirección del sitio web de la institución, si lo tiene',
        'foundation_date'=>'Fecha de fundación de la institución, si se conoce',
        'legal_status'=>'Estado legal de la institución',
        'tax_id'=>'Número de identificación fiscal de la institución, si se conoce',
        'registration_number'=>'Número de registro de la institución, si se conoce',
        'logo'=>'Imagen del logo de la institución, almacenada como un archivo en la base de datos o en un servidor de archivos externo',
    ];

    public static function list_type() /* usada para llenar los objetos de formularios select*/
    {
        return ['Pública','Privada'];
    }
    public static function list_legal_status() /* usada para llenar los objetos de formularios select*/
    {
        return ['Empresa','Organización sin fines de lucro','Fundación','Asociación'];
    }
}

/*

'name','type','acronym','address','phone_number','email','website','foundation_date','legal_status','tax_id','registration_number','logo'

name
type
acronym
address
phone_number
email
website
foundation_date
legal_status
tax_id
registration_number
logo

*/
