<?php

namespace App\Http\Livewire\Institution\Rol;

trait RolRules
{
    protected $rules = [
        'rol.area_id' => 'required|string',
        'rol.name' => 'required|string',
        'rol.description' => 'string',
    ];

    protected function validationAttributes()
    {
        return [
            'rol.area_id' => $this->list_comment['area_id'],
            'rol.name' => $this->list_comment['name'],
            'rol.description' => $this->list_comment['description'],
        ];
    }
}
