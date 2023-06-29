<?php

namespace App\Http\Livewire\Institution\Autority;

trait AuthorityRules
{
    protected $rules = [
        'authority.institution_id' => 'required|string',
        'authority.name' => 'required|string',
        'authority.ci' => 'required|integer',
        'authority.position' => 'required|string',
        'authority.email' => 'required|string|email',
        'authority.phone_number' => 'required|string',
        'authority.address' => 'required|string',
        'authority.profile_professional' => 'required|string',
        'authority.finicial' => 'required|date',
        'authority.ffinal' => 'required|date',
        'authority.photo' => 'nullable|string',
    ];

    protected function validationAttributes()
    {
        return [
            'authority.institution_id' => $this->list_comment['institution_id'],
            'authority.name' => $this->list_comment['name'],
            'authority.ci' => $this->list_comment['ci'],
            'authority.position' => $this->list_comment['position'],
            'authority.email' => $this->list_comment['email'],
            'authority.phone_number' => $this->list_comment['phone_number'],
            'authority.address' => $this->list_comment['address'],
            'authority.profile_professional' => $this->list_comment['profile_professional'],
            'authority.finicial' => $this->list_comment['finicial'],
            'authority.ffinal' => $this->list_comment['ffinal'],
            'authority.photo' => $this->list_comment['photo'],
        ];
    }
}
