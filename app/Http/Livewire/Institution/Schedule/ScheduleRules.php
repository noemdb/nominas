<?php

namespace App\Http\Livewire\Institution\Schedule;

trait ScheduleRules
{
    protected $rules = [
        'schedule.weekday' => 'required|numeric|min:1|max:25',
        'schedule.start_time' => 'required|date_format:H:i',
        'schedule.end_time' => 'required|date_format:H:i',
        'schedule.schedule_type' => 'required|string',
        'schedule.area_id' => 'required|string',
        'schedule.rol_id' => 'required|string',
        'schedule.notes' => 'string',
    ];

    protected function validationAttributes()
    {
        return [
            'schedule.weekday' => $this->list_comment['weekday'],
            'schedule.start_time' => $this->list_comment['start_time'],
            'schedule.end_time' => $this->list_comment['end_time'],
            'schedule.schedule_type' => $this->list_comment['schedule_type'],
            'schedule.area_id' => $this->list_comment['area_id'],
            'schedule.rol_id' => $this->list_comment['rol_id'],
            'schedule.notes' => $this->list_comment['notes'],
        ];
    }
}
