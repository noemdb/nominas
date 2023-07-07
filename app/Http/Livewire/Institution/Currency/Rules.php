<?php

namespace App\Http\Livewire\Institution\Currency;

trait Rules
{
  protected $rules = [
    'currency.institution_id' => 'required|integer',
    'currency.name' => 'required|string',
    'currency.symbol' => 'required|string',
    'currency.lg' => 'nullable|string',
    'currency.md' => 'nullable|string',
    'currency.sm' => 'nullable|string',
    'currency.observations' => 'nullable|string',
    'currency.status_referential' => 'nullable|boolean',
    'currency.status_cripto' => 'nullable|boolean',
    'currency.status_forgering' => 'nullable|boolean',
  ];

  protected function validationAttributes()
  {
    return [
      'currency.institution_id' => $this->list_comment['institution_id'],
      'currency.name' => $this->list_comment['name'],
      'currency.symbol' => $this->list_comment['symbol'],
      'currency.lg' => $this->list_comment['lg'],
      'currency.md' => $this->list_comment['md'],
      'currency.sm' => $this->list_comment['sm'],
      'currency.observations' => $this->list_comment['observations'],
      'currency.status_referential' => $this->list_comment['status_referential'],
      'currency.status_cripto' => $this->list_comment['status_cripto'],
      'currency.status_forgering' => $this->list_comment['status_forgering'],
    ];
  }
}
