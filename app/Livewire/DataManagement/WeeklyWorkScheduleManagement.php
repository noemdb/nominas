<?php

namespace App\Livewire\DataManagement;

use App\Models\Position;
use App\Models\WeeklyWorkSchedule;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Collection;

class WeeklyWorkScheduleManagement extends Component
{
    use WithPagination;

    // Properties for form handling
    public $position_id;
    public $day_of_week;
    public $planned_hours;
    public $observations;
    public $is_active = true;
    public $editingScheduleId = null;
    public $showDeleteModal = false;
    public $scheduleToDelete = null;
    public $showModal = false;

    // Properties for filtering and searching
    public $search = '';
    public $selectedPosition = null;
    public $filterActive = true;

    // Properties for validation messages
    protected $messages = [
        'position_id.required' => 'Debe seleccionar un cargo.',
        'day_of_week.required' => 'Debe seleccionar un día de la semana.',
        'planned_hours.required' => 'Debe especificar las horas planificadas.',
        'planned_hours.numeric' => 'Las horas planificadas deben ser un número.',
        'planned_hours.min' => 'Las horas planificadas no pueden ser negativas.',
        'planned_hours.max' => 'Las horas planificadas no pueden exceder 24 horas.',
    ];

    protected function rules()
    {
        return [
            'position_id' => 'required|exists:positions,id',
            'day_of_week' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'planned_hours' => 'required|numeric|min:0|max:24',
            'is_active' => 'boolean',
            'observations' => 'nullable|string|max:1000',
        ];
    }

    public function mount()
    {
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset([
            'position_id',
            'day_of_week',
            'planned_hours',
            'observations',
            'is_active',
            'editingScheduleId'
        ]);
        $this->closeModal();
    }

    /**
     * Close the modal
     */
    public function closeModal()
    {
        $this->showModal = false;
        $this->editingScheduleId = null;
    }

    /**
     * Open the modal for creating a new schedule
     */
    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    /**
     * Open the modal for editing an existing schedule
     */
    public function edit($scheduleId)
    {
        $schedule = WeeklyWorkSchedule::findOrFail($scheduleId);
        $this->editingScheduleId = $schedule->id;
        $this->position_id = $schedule->position_id;
        $this->day_of_week = $schedule->day_of_week;
        $this->planned_hours = $schedule->planned_hours;
        $this->is_active = $schedule->is_active;
        $this->observations = $schedule->observations;
        $this->showModal = true;
    }

    public function save()
    {
        if ($this->editingScheduleId) {
            $this->update();
        } else {
            $this->store();
        }
    }

    public function store()
    {
        $this->validate();

        // Check if schedule already exists for this position and day
        $existingSchedule = WeeklyWorkSchedule::where('position_id', $this->position_id)
            ->where('day_of_week', $this->day_of_week)
            ->first();

        if ($existingSchedule) {
            $this->addError('day_of_week', 'Ya existe un horario para este día en el cargo seleccionado.');
            return;
        }

        // Create new schedule
        $schedule = WeeklyWorkSchedule::create([
            'position_id' => $this->position_id,
            'day_of_week' => $this->day_of_week,
            'planned_hours' => $this->planned_hours,
            'is_active' => $this->is_active,
            'observations' => $this->observations,
        ]);

        // Validate total weekly hours
        if (!$schedule->isValidSchedule()) {
            $schedule->delete();
            $this->addError('planned_hours', 'El total de horas semanales no puede exceder 40 horas.');
            return;
        }

        $this->resetForm();
        $this->dispatch('schedule-created', 'Horario creado exitosamente.');
    }

    public function update()
    {
        $this->validate();

        $schedule = WeeklyWorkSchedule::findOrFail($this->editingScheduleId);

        // Check if schedule already exists for this position and day (excluding current schedule)
        $existingSchedule = WeeklyWorkSchedule::where('position_id', $this->position_id)
            ->where('day_of_week', $this->day_of_week)
            ->where('id', '!=', $this->editingScheduleId)
            ->first();

        if ($existingSchedule) {
            $this->addError('day_of_week', 'Ya existe un horario para este día en el cargo seleccionado.');
            return;
        }

        // Update schedule
        $schedule->update([
            'position_id' => $this->position_id,
            'day_of_week' => $this->day_of_week,
            'planned_hours' => $this->planned_hours,
            'is_active' => $this->is_active,
            'observations' => $this->observations,
        ]);

        // Validate total weekly hours
        if (!$schedule->isValidSchedule()) {
            $this->addError('planned_hours', 'El total de horas semanales no puede exceder 40 horas.');
            return;
        }

        $this->resetForm();
        $this->dispatch('schedule-updated', 'Horario actualizado exitosamente.');
    }

    public function confirmDelete($scheduleId)
    {
        $this->scheduleToDelete = $scheduleId;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $schedule = WeeklyWorkSchedule::findOrFail($this->scheduleToDelete);
        $schedule->delete();

        $this->showDeleteModal = false;
        $this->scheduleToDelete = null;
        $this->dispatch('schedule-deleted', 'Horario eliminado exitosamente.');
    }

    public function getDaysOfWeekProperty(): array
    {
        return WeeklyWorkSchedule::DAYS_OF_WEEK;
    }

    public function getPositionsProperty()
    {
        return Position::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getWeeklyHoursProperty(): float
    {
        if (!$this->position_id) {
            return 0;
        }

        return WeeklyWorkSchedule::getTotalWeeklyHours($this->position_id);
    }

    public function getMonthlyHoursProperty(): float
    {
        if (!$this->position_id) {
            return 0;
        }

        return WeeklyWorkSchedule::getMonthlyEstimatedHours($this->position_id);
    }

    /**
     * Get the position options for the select component
     */
    public function getPositionOptionsProperty()
    {
        return Position::getSelectOptions();
    }

    /**
     * Get the worker information for the selected position
     */
    public function getWorkerInfoProperty()
    {
        if (!$this->position_id) {
            return null;
        }

        $position = Position::with('worker')->find($this->position_id);
        return $position?->worker;
    }

    /**
     * Get the schedule for the selected position
     */
    public function getPositionScheduleProperty()
    {
        if (!$this->position_id) {
            return collect();
        }

        return WeeklyWorkSchedule::where('position_id', $this->position_id)
            ->where('is_active', true)
            ->get()
            ->keyBy('day_of_week');
    }

    /**
     * Get the position information for the selected position
     */
    public function getPositionInfoProperty()
    {
        if (!$this->position_id) {
            return null;
        }

        return Position::with(['area', 'rol'])->find($this->position_id);
    }

    /**
     * Select a day from the calendar
     */
    public function selectDay($day)
    {
        $this->day_of_week = $day;
    }

    public function render()
    {
        $query = WeeklyWorkSchedule::query()
            ->with(['position.worker', 'position.area', 'position.rol'])
            ->when($this->selectedPosition, function ($query) {
                return $query->where('position_id', $this->selectedPosition);
            })
            ->when($this->filterActive, function ($query) {
                return $query->where('is_active', true);
            })
            ->when($this->search, function ($query) {
                return $query->whereHas('position', function ($q) {
                    $q->whereHas('worker', function ($q) {
                        $q->where('first_name', 'like', '%' . $this->search . '%')
                            ->orWhere('last_name', 'like', '%' . $this->search . '%');
                    });
                });
            })
            ->orderBy('position_id')
            ->orderByRaw("FIELD(day_of_week, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')");

        return view('livewire.data-management.weekly-work-schedule-management', [
            'schedules' => $query->paginate(10),
            'positionOptions' => $this->positionOptions,
            'daysOfWeek' => $this->daysOfWeek,
            'weeklyHours' => $this->weeklyHours,
            'monthlyHours' => $this->monthlyHours,
            'workerInfo' => $this->workerInfo,
            'positionInfo' => $this->positionInfo,
            'positionSchedule' => $this->positionSchedule,
        ]);
    }
}
