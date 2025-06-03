<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'institution_id', 'description'];

    /**
     * Get the institution that owns the area.
     */
    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    /**
     * Get the institution name.
     */
    public function getInstitutionNameAttribute()
    {
        return $this->institution ? $this->institution->name : null;
    }

    public static function getSelectOptions()
    {
        return self::with('institution')->get()->map(fn($area) => [
            'label' => $area->name,
            'value' => $area->id,
            'description' => $area->description,
            'institution' => $area->institution_name
        ]);
    }
}
