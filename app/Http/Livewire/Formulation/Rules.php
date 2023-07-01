<?php

namespace App\Http\Livewire\Formulation;

trait Rules
{
    protected $rules = [
        'formulation.institution_id' => 'required|integer',
        'formulation.latex' => 'required|string',
        'formulation.name' => 'required|string',
        'formulation.description' => 'nullable|string',
    ];

    protected function validationAttributes()
    {
        return [
            'formulation.institution_id' => $this->list_comment['institution_id'],
            'formulation.latex' => $this->list_comment['latex'],
            'formulation.name' => $this->list_comment['name'],
            'formulation.description' => $this->list_comment['description'],
        ];
    }
}

?>
