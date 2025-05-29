<?php

namespace App\Livewire\Setup;

use App\Models\Area;
use App\Models\Bonus;
use App\Models\Institution;
use App\Models\Rol;
use App\Models\Worker;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\WireUiActions;

class IndexBonus extends Component
{
    use WithPagination, WireUiActions;

    public $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $showModal = false;
    public $editing = false;
    public $name;
    public $description;
    public $type = 'fijo';
    public $amount;
    public $name_function;
    public $institution_id;
    public $area_id;
    public $rol_id;
    public $position_id;
    public $worker_id;
    public $status_active = false;
    public $status_exchange = false;
    public $filterPayrollId = null;
    public $filterStatusActive = null;
    public $filterStatusExchange = null;
    public $institutionOptions = [];
    public $areaOptions = [];
    public $rolOptions = [];
    public $workerOptions = [];
    public $payrollOptions = [];
    public $bonusTypeOptions = [];
    public $bonusfunctionOptions = [];

    public $isLoaded = false;

    public $showDetailsModal = false;
    public $bonusDetails = null;

    protected $rules = [
        'name' => 'required|min:3',
        'description' => 'nullable|string',
        'type' => 'required|in:fijo,variable',
        'amount' => 'required_if:type,fijo|nullable|numeric|min:0',
        'name_function' => 'nullable|string|required_if:type,variable',
        'institution_id' => 'nullable|exists:institutions,id',
        'area_id' => 'nullable|exists:areas,id',
        'rol_id' => 'nullable|exists:rols,id',
        'position_id' => 'nullable|exists:positions,id',
        'worker_id' => 'nullable|exists:workers,id',
        'status_exchange' => 'boolean',
        'status_active' => 'boolean',
    ];

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'name'],
        'sortDirection' => ['except' => 'asc'],
    ];

    public function create()
    {
        $this->resetValidation();
        $this->reset(['name', 'description', 'type', 'amount', 'name_function', 'institution_id', 'area_id', 'rol_id', 'position_id', 'worker_id', 'status_exchange']);
        $this->editing = false;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $this->resetValidation();
        $bonus = Bonus::findOrFail($id);
        $this->editing = $id;
        $this->name = $bonus->name;
        $this->description = $bonus->description;
        $this->type = $bonus->type;
        $this->amount = $bonus->amount;
        $this->name_function = $bonus->name_function;
        $this->institution_id = $bonus->institution_id;
        $this->area_id = $bonus->area_id;
        $this->rol_id = $bonus->rol_id;
        $this->position_id = $bonus->position_id;
        $this->worker_id = $bonus->worker_id;
        $this->status_exchange = $bonus->status_exchange;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        // Validate that only one applicability field is set
        $applicabilityFields = array_filter([
            $this->institution_id,
            $this->area_id,
            $this->rol_id,
            $this->position_id,
            $this->worker_id
        ]);

        if (count($applicabilityFields) > 1) {
            $this->addError('applicability', 'Only one applicability field can be set.');
            return;
        }

        if ($this->editing) {
            Bonus::find($this->editing)->update([
                'name' => $this->name,
                'description' => $this->description,
                'type' => $this->type,
                'amount' => $this->type === 'fijo' ? $this->amount : null,
                'name_function' => $this->type === 'variable' ? $this->name_function : null,
                'institution_id' => $this->institution_id,
                'area_id' => $this->area_id,
                'rol_id' => $this->rol_id,
                'position_id' => $this->position_id,
                'worker_id' => $this->worker_id,
                'status_exchange' => $this->status_exchange,
                'status_active' => $this->status_active,
            ]);
            $this->notification()->success(
                'Bonificación Actualizada',
                'La bonificación ha sido actualizada correctamente.'
            );
        } else {
            Bonus::create([
                'name' => $this->name,
                'description' => $this->description,
                'type' => $this->type,
                'amount' => $this->type === 'fijo' ? $this->amount : null,
                'name_function' => $this->type === 'variable' ? $this->name_function : null,
                'institution_id' => $this->institution_id,
                'area_id' => $this->area_id,
                'rol_id' => $this->rol_id,
                'position_id' => $this->position_id,
                'worker_id' => $this->worker_id,
                'status_exchange' => $this->status_exchange,
                'status_active' => $this->status_active,
            ]);
            $this->notification()->success(
                'Bonificación Creada',
                'La bonificación ha sido creada correctamente.'
            );
        }

        $this->showModal = false;
        $this->reset(['name', 'description', 'type', 'amount', 'name_function', 'institution_id', 'area_id', 'rol_id', 'position_id', 'worker_id', 'editing', 'status_exchange']);
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->showDetailsModal = false;
        $this->reset(['name', 'description', 'type', 'amount', 'name_function', 'institution_id', 'area_id', 'rol_id', 'position_id', 'worker_id', 'editing', 'status_exchange']);
        $this->resetValidation();
    }

    public function viewDetails($id)
    {
        $this->bonusDetails = Bonus::findOrFail($id);
        $this->showDetailsModal = true;
    }

    public function closeDetailsModal()
    {
        $this->showDetailsModal = false;
        $this->bonusDetails = null;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function confirmDelete($id): void
    {
        $bonus = Bonus::findOrFail($id);
        $this->dialog()->confirm([
            'title' => '¿Eliminar Bonificación?',
            'description' => "¿Está seguro de eliminar la bonificación '$bonus->name'? Esta acción no se puede deshacer.",
            'acceptLabel' => 'Sí, eliminar',
            'rejectLabel' => 'No, cancelar',
            'method' => 'delete',
            'params' => $id,
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

    public function delete($id)
    {
        $bonus = Bonus::find($id);
        if ($bonus) {
            $bonus->delete();
            $this->notification()->success(
                'Bonificación Eliminada',
                'La bonificación ha sido eliminada correctamente.'
            );
        }
    }

    public function confirmClone($id): void
    {
        $bonus = Bonus::findOrFail($id);
        $this->dialog()->confirm([
            'title' => '¿Clonar Bonificación?',
            'description' => "¿Está seguro de clonar la bonificación '$bonus->name'? Se creará una nueva bonificación con los mismos datos pero con estados iniciales.",
            'acceptLabel' => 'Sí, clonar',
            'rejectLabel' => 'No, cancelar',
            'method' => 'cloneBonus',
            'params' => $id,
            'accept' => [
                'label' => 'Sí, clonar',
                'color' => 'primary'
            ],
            'reject' => [
                'label' => 'No, cancelar'
            ]
        ]);
    }

    public function cloneBonus($id)
    {
        $bonus = Bonus::findOrFail($id);

        // Crear una nueva bonificación basada en la existente
        $newBonus = $bonus->replicate();
        $newBonus->name = $bonus->name . ' (Copia)';
        $newBonus->status_active = false; // Set initial status to inactive
        // You might want to reset other fields as needed for a new bonus clone

        $newBonus->save();

        $this->notification()->success(
            'Bonificación Clonada',
            'La bonificación ha sido clonada correctamente.'
        );
    }

    public function mount()
    {
        $this->institutionOptions = Institution::getSelectOptions();
        $this->areaOptions = Area::getSelectOptions();
        $this->rolOptions = Rol::getSelectOptions();
        $this->workerOptions = Worker::getSelectOptions();
        $this->bonusfunctionOptions = Bonus::FUNCTIONS;
        $this->bonusTypeOptions = Bonus::TYPES;
        $this->payrollOptions = \App\Models\Payroll::getSelectOptions();
    }

    public function render()
    {
        return view('livewire.setup.index-bonus', [
            'bonuses' => Bonus::query()
                ->when($this->search, function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%');
                })
                ->when($this->filterPayrollId, function ($query) {
                    $query->whereHas('payrolls', function ($q) {
                        $q->where('payrolls.id', $this->filterPayrollId);
                    });
                })
                ->when(isset($this->filterStatusActive), function ($query) {
                    $query->where('status_active', $this->filterStatusActive);
                })
                ->when(isset($this->filterStatusExchange), function ($query) {
                    $query->where('status_exchange', $this->filterStatusExchange);
                })
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10),
            'sortField' => $this->sortField,
            'sortDirection' => $this->sortDirection
        ]);
    }
}
