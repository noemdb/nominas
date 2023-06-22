<?php

namespace App\Models\Institution;

use App\Models\Institution;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [
        'institution_id', 'name', 'description'
    ];

    const COLUMN_COMMENTS = [
        'institution_id'=>'Institución',
        'name'=>'Nombre',
        'description'=>'Descripción',
    ];

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
institution_id
name
description

'institution_id', 'name', 'description'


*/
