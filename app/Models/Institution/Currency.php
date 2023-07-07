<?php

namespace App\Models\Institution;

use App\Models\Institution;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $fillable = [
        'institution_id','name','symbol','lg','md','sm','observations','status_referential','status_cripto','status_forgering'
    ];

    const COLUMN_COMMENTS = [
        'institution_id'=>'Institución',
        'name'=>'Nombre',
        'symbol'=>'Símbolo',
        'lg'=>'Símbolo Grande',
        'md'=>'Símbolo Medio',
        'sm'=>'Símbolo Corto',
        'observations'=>'Observaciones',
        'status_referential'=>'Referencial',
        'status_cripto'=>'Cripto',
        'status_forgering'=>'Extranjera',
        /////////////////////////////////////////
        'institution_name'=>'Institución',
    ];

    public static function list_currency_type() /* usada para llenar los objetos de formularios select*/
    {
        // return ['Cuenta corriente','Cuenta de ahorros'];
    }

    public function getInstitutionNameAttribute()
    {
        return ($this->institution) ? $this->institution->name : null ;
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public static function list_currency() /* usada para llenar los objetos de formularios select*/
    {
        return Currency::pluck('name', 'id');
    }
}
/*

'institution_id','name','symbol','lg','md','sm','observations','status_referential','status_cripto','status_forgering'

*/
