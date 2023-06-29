<?php

namespace App\Http\Livewire\Employee\Position;

// 'employee_id','area_id','rol_id','name','description','start','end'

trait Rules
{
    protected $rules = [
        'position.employee_id' => 'required|integer',
        'position.area_id' => 'required|integer',
        'position.rol_id' => 'required|integer',
        'position.name' => 'required|string',
        'position.description' => 'required|string',
        'position.start' => 'required|date',
        'position.end' => 'required|date',
        'position.status' => 'required|boolean',
    ];

    protected function validationAttributes()
    {
        return [
            'position.employee_id' => $this->list_comment['employee_id'],
            'position.area_id' => $this->list_comment['area_id'],
            'position.rol_id' => $this->list_comment['rol_id'],
            'position.name' => $this->list_comment['name'],
            'position.description' => $this->list_comment['description'],
            'position.start' => $this->list_comment['start'],
            'position.end' => $this->list_comment['end'],
            'position.status' => $this->list_comment['status'],

        ];
    }
}

?>
