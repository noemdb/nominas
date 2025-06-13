<?php

namespace App\Livewire\DataManagement;

use App\Models\Area;
use App\Models\Position;
use App\Models\Rol;
use App\Models\Worker;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\WireUiActions;

class PositionsManager extends Component
{

    use WithPagination;
    use WireUiActions;

    public $areas, $rols, $workers;
    public $position_id, $start_date, $end_date, $observations, $is_active, $area_id, $rol_id, $worker_id;

    public $confirmingDelete = false;
    public $deleteId = null;

    // Nuevo atributo para almacenar el worker_id recibido como parámetro
    public $selected_worker, $selected_worker_id, $activePosition = null;
    public $areaOptions = [];
    public $rolOptions = [];
    public $workerOptions = [];

    public $isOpenPosition = false; // Para controlar el modal
    public $isEditPosition = false; // Para diferenciar entre crear y editar

    protected $rules = [
        'start_date' => 'required|date',
        // 'end_date' => 'nullable|date|after:start_date',
        'observations' => 'nullable|string|max:1000',
        'is_active' => 'boolean',
        'area_id' => 'required|exists:areas,id',
        'rol_id' => 'required|exists:rols,id',
        'worker_id' => 'required|exists:workers,id',
    ];

    protected $messages = [
        'start_date.required' => 'La fecha de inicio es obligatoria.',
        'start_date.date' => 'La fecha de inicio debe ser una fecha válida.',
        'end_date.date' => 'La fecha de fin debe ser una fecha válida.',
        'end_date.after' => 'La fecha de fin debe ser posterior a la fecha de inicio.',
        'observations.string' => 'Las observaciones deben ser texto.',
        'observations.max' => 'Las observaciones no pueden exceder los 1000 caracteres.',
        'is_active.boolean' => 'El estado activo debe ser verdadero o falso.',
        'area_id.required' => 'Debe seleccionar un área.',
        'area_id.exists' => 'El área seleccionada no existe.',
        'rol_id.required' => 'Debe seleccionar un rol.',
        'rol_id.exists' => 'El rol seleccionado no existe.',
        'worker_id.required' => 'Debe seleccionar un trabajador.',
        'worker_id.exists' => 'El trabajador seleccionado no existe.',
    ];

    protected $validationAttributes = [
        'start_date' => 'fecha de inicio',
        'end_date' => 'fecha de fin',
        'observations' => 'observaciones',
        'is_active' => 'estado activo',
        'area_id' => 'área',
        'rol_id' => 'rol',
        'worker_id' => 'trabajador',
    ];

    public function mount($worker_id = null)
    {
        try {
            $this->areaOptions = Area::getSelectOptions();
            $this->rolOptions = Rol::getSelectOptions();
            $this->workerOptions = Worker::getSelectOptions();

            // Asignar el worker_id recibido como parámetro
            if ($worker_id) {
                $this->selected_worker = Worker::find($worker_id);
                $this->selected_worker_id = $this->selected_worker ? $worker_id : null;
            }
        } catch (\Exception $e) {
            $this->notification()->error(
                'Error',
                'Error al cargar los datos iniciales: ' . $e->getMessage()
            );
            $this->areas = collect();
            $this->rols = collect();
            $this->workers = collect();
        }
    }

    public function render()
    {
        try {
            // Asegurarnos de que las colecciones estén disponibles
            if (!$this->areas) {
                $this->areas = Area::where('status_active', true)->get();
            }
            if (!$this->rols) {
                $this->rols = Rol::all();
            }
            if (!$this->workers) {
                $this->workers = Worker::where('is_active', true)->get();
            }

            // Filtrar las posiciones por el worker_id seleccionado
            $query = Position::with(['area', 'rol', 'worker']);

            if ($this->selected_worker_id) {
                $query->where('worker_id', $this->selected_worker_id);
            }

            $positions = $query->paginate(10);

            return view('livewire.data-management.positions-manager', [
                'positions' => $positions,
                'areas' => $this->areas,
                'rols' => $this->rols,
                'workers' => $this->workers
            ]);
        } catch (\Exception $e) {
            $this->notification()->error(
                'Error',
                'Error al renderizar la vista: ' . $e->getMessage()
            );
            return view('livewire.data-management.positions-manager', [
                'positions' => collect(),
                'areas' => collect(),
                'rols' => collect(),
                'workers' => collect()
            ]);
        }
    }

    public function createPosition()
    {
        $this->resetInputFieldsPosition();
        $this->isOpenPosition = true;
        $this->isEditPosition = false;
        if ($this->selected_worker_id) {
            $this->worker_id = $this->selected_worker_id;
        }
    }

    public function editPosition($id)
    {
        $position = Position::findOrFail($id); // dd($position);
        $this->position_id = $position->id;
        $this->start_date = $position->start_date;
        $this->end_date = $position->end_date;
        $this->observations = $position->observations;
        $this->is_active = $position->is_active;
        $this->area_id = $position->area_id;
        $this->rol_id = $position->rol_id;
        $this->worker_id = $position->worker_id;

        $this->isOpenPosition = true;
        $this->isEditPosition = true;
    }

    public function closePosition()
    {
        $this->worker_id = false;
        $this->isOpenPosition = false;
        $this->isEditPosition = false;
    }

    public function storePosition()
    {
        try {
            $validate = $this->validate($this->rules, $this->messages, $this->validationAttributes);

            // Validar que no exista una posición activa en el mismo rango de fechas
            $existingPosition = Position::where('worker_id', $this->worker_id)
                ->where('is_active', true)
                ->where(function ($query) {
                    $query->where(function ($q) {
                        // La nueva posición comienza durante una posición existente
                        $q->where('start_date', '<=', $this->start_date)
                            ->where(function ($q) {
                                $q->whereNull('end_date')
                                    ->orWhere('end_date', '>=', $this->start_date);
                            });
                    })->orWhere(function ($q) {
                        // La nueva posición termina durante una posición existente
                        $q->where('start_date', '<=', $this->end_date)
                            ->where(function ($q) {
                                $q->whereNull('end_date')
                                    ->orWhere('end_date', '>=', $this->end_date);
                            });
                    })->orWhere(function ($q) {
                        // La nueva posición contiene completamente una posición existente
                        $q->where('start_date', '>=', $this->start_date)
                            ->where(function ($q) {
                                $q->whereNull('end_date')
                                    ->orWhere('end_date', '<=', $this->end_date);
                            });
                    });
                });

            // Si estamos editando, excluir la posición actual de la validación
            if ($this->isEditPosition) {
                $existingPosition->where('id', '!=', $this->position_id);
            }

            if ($existingPosition->exists()) {
                $this->addError('start_date', 'El trabajador ya tiene una posición activa que se solapa con el período especificado. Por favor, verifique las fechas.');
                $this->notification()->error(
                    'Error de Validación',
                    'No se puede crear/actualizar la posición porque el trabajador ya tiene una posición activa en el período especificado.'
                );
                return;
            }

            $arr = [
                'start_date' => $this->start_date,
                // 'end_date' => $this->end_date,
                'end_date' => '2050-12-31',
                'observations' => $this->observations,
                'is_active' => $this->is_active,
                'area_id' => $this->area_id,
                'rol_id' => $this->rol_id,
                'worker_id' => $this->worker_id,
            ];

            if ($this->isEditPosition) {
                $position = Position::where('id', $this->position_id)->update($arr);
                $message = 'Cargo actualizado exitosamente.';
            } else {
                $position = Position::create($arr);
                $message = 'Cargo creado exitosamente.';
            }

            $this->resetInputFieldsPosition();
            $this->notification()->success(
                '¡Éxito!',
                $message
            );
            $this->resetErrorBag();
            $this->closeModalPosition();
        } catch (\Exception $e) {
            $this->notification()->error(
                'Error',
                'Ha ocurrido un error al procesar la solicitud: ' . $e->getMessage()
            );
            $this->addError('general', $e->getMessage());
        }
    }

    public function deletePosition($id)
    {
        Position::findOrFail($id)->delete();
        session()->flash('message', 'Cargo eliminado exitosamente.');
    }

    public function confirmDeletePosition($id)
    {
        $this->confirmingDelete = true;
        $this->deleteId = $id;
    }

    public function closeModalPosition()
    {
        $this->isOpenPosition = false;
        $this->resetInputFieldsPosition();
    }

    private function resetInputFieldsPosition()
    {
        $this->position_id = null;
        $this->start_date = null;
        $this->end_date = null;
        $this->observations = null;
        $this->is_active = false;
        $this->area_id = null;
        $this->rol_id = null;
        $this->worker_id = $this->selected_worker_id; // Mantener el worker_id seleccionado
    }

    public function successNotification(): void
    {
        $this->notification()->send([
            'icon' => 'success',
            'title' => 'Realizado!',
            'description' => 'Accion ejecutada.',
        ]);
    }
}
