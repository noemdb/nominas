<?php

namespace App\Http\Livewire\Employee\Position;

// 'employee_id','area_id','rol_id','name','description','start','end','frequency_workday','workday'

trait Rules
{
    protected $rules = [
        'position.employee_id' => 'required|integer',
        'position.area_id' => 'required|integer',
        'position.rol_id' => 'required|integer',
        'position.name' => 'required|string',
        'position.description' => 'required|string',
        'position.contract_type' => 'required|string',
        'position.start' => 'required|date',
        'position.end' => 'required|date',
        'position.frequency_workday' => 'nullable|string',
        'position.workday' => 'nullable|integer',
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
            'position.contract_type' => $this->list_comment['contract_type'],
            'position.start' => $this->list_comment['start'],
            'position.end' => $this->list_comment['end'],
            'position.frequency_workday' => $this->list_comment['frequency_workday'],
            'position.workday' => $this->list_comment['workday'],
            'position.status' => $this->list_comment['status'],

        ];
    }
}

?>
