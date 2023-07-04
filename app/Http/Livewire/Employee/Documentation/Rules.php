<?php

namespace App\Http\Livewire\Employee\Documentation;

// 'employee_id','address','city','state','zip_code','country','phone_number','home_phone','emergency_contact_name','emergency_contact_relationship','emergency_contact_phone','emergency_contact_email','other_details',

trait Rules
{
    protected $rules = [
        'documentation.employee_id' => 'required|integer',
        'documentation.description' => 'required|string',
        'documentation.type' => 'required|string',
        'documentation.number' => 'nullable|string',
        'documentation.expiration_date' => 'nullable|date',
        'documentation.issue_date' => 'nullable|date',
        'documentation.country' => 'nullable|string',
        'documentation.file' => 'nullable|nullable',
        'documentation.comments' => 'nullable|string',
    ];

    protected function validationAttributes()
    {
        return [
            'documentation.employee_id' => $this->list_comment['employee_id'],
            'documentation.description' => $this->list_comment['description'],
            'documentation.type' => $this->list_comment['type'],
            'documentation.number' => $this->list_comment['number'],
            'documentation.expiration_date' => $this->list_comment['expiration_date'],
            'documentation.issue_date' => $this->list_comment['issue_date'],
            'documentation.country' => $this->list_comment['country'],
            'documentation.file' => $this->list_comment['file'],
            'documentation.comments' => $this->list_comment['comments'],
        ];
    }
}

?>
