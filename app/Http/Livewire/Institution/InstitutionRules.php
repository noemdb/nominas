<?php

namespace App\Http\Livewire\Institution;

trait InstitutionRules
{
    protected $rules = [
        'institution.name' => 'required|string',
        'institution.type' => 'required|string',
        'institution.acronym' => 'nullable|string|max:5',
        'institution.address' => 'required|string|max:192',
        'institution.phone_number' => 'required|string',
        'institution.email' => 'required|email',
        'institution.website' => 'nullable|string',
        'institution.foundation_date' => 'nullable|date',
        'institution.legal_status' => 'required|string',
        'institution.tax_id' => 'required|string',
        'institution.registration_number' => 'required|string',
    ];

    protected function validationAttributes()
    {
        return [
            'institution.name' => $this->list_comment['name'],
            'institution.type' => $this->list_comment['type'],
            'institution.acronym' => $this->list_comment['acronym'],
            'institution.address' => $this->list_comment['address'],
            'institution.phone_number' => $this->list_comment['phone_number'],
            'institution.email' => $this->list_comment['email'],
            'institution.website' => $this->list_comment['website'],
            'institution.foundation_date' => $this->list_comment['foundation_date'],
            'institution.legal_status' => $this->list_comment['legal_status'],
            'institution.tax_id' => $this->list_comment['tax_id'],
            'institution.registration_number' => $this->list_comment['registration_number'],
        ];
    }
}

?>
