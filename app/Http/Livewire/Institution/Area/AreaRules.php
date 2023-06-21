<?php

namespace App\Http\Livewire\Institution\Area;

trait AreaRules
{
  protected $rules = [
    'area.institution_id' => 'required|string',
    'area.name' => 'required|string',
    'area.description' => 'required|string',
  ];

  protected function validationAttributes()
  {
    return [
      'area.institution_id' => $this->list_comment['institution_id'],
      'area.name' => $this->list_comment['name'],
      'area.description' => $this->list_comment['description'],
    ];
  }
}
