<?php

namespace App\Livewire\DataManagement;

use App\Models\Area;
use App\Models\Position;
use App\Models\WeeklyWorkSchedule;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Collection;
use WireUi\Traits\WireUiActions;

class WeeklyWorkScheduleManagement extends Component
{
    use WithPagination, WireUiActions;

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
    public $selectedArea = null;
    public $filterActive = true;

    // Properties for validation messages
    protected $messages = [
        'position_id.required' => 'Debe seleccionar un cargo.',
        'day_of_week.required' => 'Debe seleccionar un día de la semana.',
        'planned_hours.required' => 'Debe especificar las horas planificadas.',
        'planned_hours.numeric' => 'Las horas planificadas deben ser un número.',
        'planned_hours.min' => 'Las horas planificadas no pueden ser negativas.',
        'planned_hours.max' => 'Las horas planificadas no pueden exceder 24 horas.',
        'position_id.exists' => 'El cargo seleccionado no existe.',
        'day_of_week.in' => 'El día de la semana seleccionado no es válido.',
        'observations.max' => 'Las observaciones no pueden exceder los 1000 caracteres.',
    ];

    protected function rules()
    {
        return [
            'position_id' => [
                'required',
                'exists:positions,id',
                function ($attribute, $value, $fail) {
                    // Validación personalizada para evitar duplicados
                    $query = WeeklyWorkSchedule::where('position_id', $value)
                        ->where('day_of_week', $this->day_of_week)
                        ->where('is_active', true);

                    // Si estamos editando, excluimos el registro actual
                    if ($this->editingScheduleId) {
                        $query->where('id', '!=', $this->editingScheduleId);
                    }

                    if ($query->exists()) {
                        $dayName = WeeklyWorkSchedule::DAYS_OF_WEEK[$this->day_of_week] ?? $this->day_of_week;
                        $fail("Ya existe un horario activo para el día {$dayName} en este cargo.");
                    }
                },
            ],
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
    }

    /**
     * Close the modal
     */
    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
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
        try {
            // Resetear mensajes de validación
            $this->resetErrorBag();
            $this->resetValidation();

            // Verificar si es fin de semana
            if (in_array($this->day_of_week, ['Saturday', 'Sunday'])) {
                $dayName = WeeklyWorkSchedule::DAYS_OF_WEEK[$this->day_of_week];
                $this->dialog()->confirm([
                    'title' => '¿Confirmar horario de fin de semana?',
                    'description' => "Está intentando crear un horario para el día {$dayName}. ¿Está seguro de que desea continuar?",
                    'acceptLabel' => 'Sí, continuar',
                    'rejectLabel' => 'No, cancelar',
                    'method' => 'proceedWithSave',
                    'accept' => [
                        'label' => 'Sí, continuar',
                        'color' => 'primary'
                    ],
                    'reject' => [
                        'label' => 'No, cancelar',
                        'color' => 'gray'
                    ]
                ]);
                return;
            }

            $this->proceedWithSave();
        } catch (\Throwable $e) {
            report($e); // Registrar el error en los logs
            $this->addError('general', 'Ha ocurrido un error al procesar la operación. Por favor, intente nuevamente..');
            return;
        }
    }

    public function proceedWithSave()
    {
        try {
            $this->validate();

            if ($this->editingScheduleId) {
                $success = $this->update();
                if ($success) {
                    $this->resetErrorBag();
                    $this->dispatch('schedule-saved');
                    // En modo edición no reseteamos ningún campo
                }
            } else {
                $success = $this->store();
                if ($success) {
                    $this->resetErrorBag();
                    $this->dispatch('schedule-saved');
                    // Solo en modo creación reseteamos todos los campos
                    $this->reset([
                        'day_of_week',
                        'planned_hours',
                        'observations',
                        'is_active',
                        'editingScheduleId'
                    ]);
                }
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->addError('general', 'Por favor, verifique los datos ingresados.');
            foreach ($e->validator->errors()->messages() as $field => $errors) {
                foreach ($errors as $error) {
                    $this->addError($field, $error);
                }
            }
        } catch (\Throwable $e) {
            report($e);
            if ($e instanceof \Illuminate\Database\QueryException) {
                $this->addError('general', 'Error al guardar en la base de datos. Por favor, intente nuevamente.');
            } else {
                $this->addError('general', 'Ha ocurrido un error inesperado. Por favor, intente nuevamente.');
            }
        }
    }

    public function store()
    {
        try {
            $schedule = WeeklyWorkSchedule::create([
                'position_id' => $this->position_id,
                'day_of_week' => $this->day_of_week,
                'planned_hours' => $this->planned_hours,
                'is_active' => $this->is_active,
                'observations' => $this->observations,
            ]);

            if (!$schedule->isValidSchedule()) {
                $schedule->delete();
                $this->addError('planned_hours', 'El total de horas semanales no puede exceder 50 horas.');
                return false;
            }

            $this->notification()->success(
                'Horario Creado',
                'El horario ha sido creado correctamente.'
            );
            return true;
        } catch (\Illuminate\Database\QueryException $e) {
            report($e);
            if (str_contains($e->getMessage(), 'Duplicate entry')) {
                $this->addError('day_of_week', 'Ya existe un horario para este día en el cargo seleccionado.');
            } else {
                $this->addError('general', 'Error al crear el horario en la base de datos.');
            }
            return false;
        } catch (\Throwable $e) {
            report($e);
            $this->addError('general', 'Error al crear el horario. Por favor, intente nuevamente.');
            return false;
        }
    }

    public function update()
    {
        try {
            $schedule = WeeklyWorkSchedule::findOrFail($this->editingScheduleId);

            $schedule->update([
                'position_id' => $this->position_id,
                'day_of_week' => $this->day_of_week,
                'planned_hours' => $this->planned_hours,
                'is_active' => $this->is_active,
                'observations' => $this->observations,
            ]);

            if (!$schedule->isValidSchedule()) {
                $this->addError('planned_hours', 'El total de horas semanales no puede exceder 50 horas.');
                return false;
            }

            $this->notification()->success(
                'Horario Actualizado',
                'El horario ha sido actualizado correctamente.'
            );
            return true;
        } catch (\Illuminate\Database\QueryException $e) {
            report($e);
            if (str_contains($e->getMessage(), 'Duplicate entry')) {
                $this->addError('day_of_week', 'Ya existe un horario para este día en el cargo seleccionado.');
            } else {
                $this->addError('general', 'Error al actualizar el horario en la base de datos.');
            }
            return false;
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            report($e);
            $this->addError('general', 'El horario que intenta actualizar no existe.');
            return false;
        } catch (\Throwable $e) {
            report($e);
            $this->addError('general', 'Error al actualizar el horario. Por favor, intente nuevamente.');
            return false;
        }
    }

    public function confirmDelete($scheduleId)
    {
        $schedule = WeeklyWorkSchedule::findOrFail($scheduleId);
        $this->scheduleToDelete = $scheduleId; // Guardamos el ID antes de mostrar el diálogo

        $this->dialog()->confirm([
            'title' => '¿Eliminar Horario?',
            'description' => "¿Está seguro de eliminar el horario del día {$schedule->getDayNameInSpanish()}? Esta acción no se puede deshacer.",
            'acceptLabel' => 'Sí, eliminar',
            'rejectLabel' => 'No, cancelar',
            'method' => 'delete',
            'accept' => [
                'label' => 'Sí, eliminar',
                'color' => 'negative'
            ],
            'reject' => [
                'label' => 'No, cancelar',
                'color' => 'gray'
            ]
        ]);
    }

    public function delete()
    {
        try {
            if (!$this->scheduleToDelete) {
                throw new \Exception('No se ha especificado el horario a eliminar.');
            }

            $schedule = WeeklyWorkSchedule::findOrFail($this->scheduleToDelete);
            $schedule->delete();

            $this->scheduleToDelete = null;
            $this->showDeleteModal = false;

            $this->notification()->success(
                'Horario Eliminado',
                'El horario ha sido eliminado correctamente.'
            );
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            report($e);
            $this->addError('general', 'El horario que intenta eliminar no existe.');
        } catch (\Illuminate\Database\QueryException $e) {
            report($e);
            $this->addError('general', 'Error al eliminar el horario de la base de datos.');
        } catch (\Throwable $e) {
            report($e);
            $this->addError('general', 'Error al eliminar el horario. Por favor, intente nuevamente.');
        }
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

    /**
     * Get the area options for the select component
     */
    public function getAreaOptionsProperty()
    {
        return Area::getSelectOptions();
    }

    public function render()
    {
        try {
            $query = WeeklyWorkSchedule::query()
                ->with(['position' => function ($query) {
                    $query->with(['worker', 'area', 'rol']);
                }])
                ->when($this->selectedPosition, function ($query) {
                    return $query->where('position_id', $this->selectedPosition);
                })
                ->when($this->selectedArea, function ($query) {
                    return $query->whereHas('position', function ($q) {
                        $q->where('area_id', $this->selectedArea);
                    });
                })
                ->when($this->filterActive, function ($query) {
                    return $query->where('is_active', true);
                })
                ->when($this->search, function ($query) {
                    return $query->whereHas('position', function ($q) {
                        $q->whereHas('worker', function ($q) {
                            $q->where(function ($q) {
                                $q->where('first_name', 'like', '%' . $this->search . '%')
                                    ->orWhere('last_name', 'like', '%' . $this->search . '%');
                            });
                        });
                    });
                })
                ->orderBy('position_id')
                ->orderByRaw("FIELD(day_of_week, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')");

            return view('livewire.data-management.weekly-work-schedule-management', [
                'schedules' => $query->paginate(10),
                'positionOptions' => $this->positionOptions,
                'areaOptions' => $this->areaOptions,
                'daysOfWeek' => $this->daysOfWeek,
                'weeklyHours' => $this->weeklyHours,
                'monthlyHours' => $this->monthlyHours,
                'workerInfo' => $this->workerInfo,
                'positionInfo' => $this->positionInfo,
                'positionSchedule' => $this->positionSchedule,
            ]);
        } catch (\Exception $e) {
            report($e);
            $this->notification()->error(
                'Error',
                'Ha ocurrido un error al cargar los datos. Por favor, intente nuevamente.'
            );
            return view('livewire.data-management.weekly-work-schedule-management', [
                'schedules' => collect(),
                'positionOptions' => collect(),
                'areaOptions' => collect(),
                'daysOfWeek' => WeeklyWorkSchedule::DAYS_OF_WEEK,
                'weeklyHours' => 0,
                'monthlyHours' => 0,
                'workerInfo' => null,
                'positionInfo' => null,
                'positionSchedule' => collect(),
            ]);
        }
    }
}
