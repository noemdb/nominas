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
    public $status_exchange = false;
    public $institutionOptions = [];
    public $areaOptions = [];
    public $rolOptions = [];
    public $workerOptions = [];
    public $bonusTypeOptions = [];
    public $bonusfunctionOptions = [];

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
        $this->reset(['name', 'description', 'type', 'amount', 'name_function', 'institution_id', 'area_id', 'rol_id', 'position_id', 'worker_id', 'editing', 'status_exchange']);
        $this->resetValidation();
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

    public function delete($id)
    {
        $bonus = Bonus::find($id);
        if ($bonus) {
            $bonus->delete();
            session()->flash('message', 'Bonus deleted successfully.');
        }
    }

    public function mount()
    {
        $this->institutionOptions = Institution::getSelectOptions();
        $this->areaOptions = Area::getSelectOptions();
        $this->rolOptions = Rol::getSelectOptions();
        $this->workerOptions = Worker::getSelectOptions();
        $this->bonusfunctionOptions = Bonus::FUNCTIONS;
        $this->bonusTypeOptions = Bonus::TYPES;
    }

    public function render()
    {
        return view('livewire.setup.index-bonus', [
            'bonuses' => Bonus::query()
                ->when($this->search, function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%');
                })
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10),
            'sortField' => $this->sortField,
            'sortDirection' => $this->sortDirection
        ]);
    }
}
