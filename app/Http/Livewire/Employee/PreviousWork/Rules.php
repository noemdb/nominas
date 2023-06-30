<?php

namespace App\Http\Livewire\Employee\PreviousWork;

trait Rules
{
    protected $rules = [
        'previous_works.employee_id' => 'required|integer',
        'previous_works.company_name' => 'required|string',
        'previous_works.position' => 'required|string',
        'previous_works.start_date' => 'required|date',
        'previous_works.end_date' => 'required|date',
        'previous_works.reason_for_leaving' => 'required|string',
        'previous_works.references' => 'string',
    ];

    protected function validationAttributes()
    {
        return [
            'previous_works.employee_id' => $this->list_comment['employee_id'],
            'previous_works.company_name' => $this->list_comment['company_name'],
            'previous_works.position' => $this->list_comment['position'],
            'previous_works.start_date' => $this->list_comment['start_date'],
            'previous_works.end_date' => $this->list_comment['end_date'],
            'previous_works.reason_for_leaving' => $this->list_comment['reason_for_leaving'],
            'previous_works.references' => $this->list_comment['references'],
        ];
    }
}

?>
