<?php

namespace App\Livewire\Setup;

use App\Models\Area;
use App\Models\Deduction;
use App\Models\Institution;
use App\Models\Position;
use App\Models\Rol;
use App\Models\Worker;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\WireUiActions;

class IndexDeduction extends Component
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
    public $institutionOptions = [];
    public $areaOptions = [];
    public $rolOptions = [];
    public $workerOptions = [];
    public $deductionTypeOptions = [];
    public $deductionfunctionOptions = [];

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
    ];

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'name'],
        'sortDirection' => ['except' => 'asc'],
    ];

    public function create()
    {
        $this->resetValidation();
        $this->reset(['name', 'description', 'type', 'amount', 'name_function', 'institution_id', 'area_id', 'rol_id', 'position_id', 'worker_id']);
        $this->editing = false;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $this->resetValidation();
        $deduction = Deduction::findOrFail($id);
        $this->editing = $id;
        $this->name = $deduction->name;
        $this->description = $deduction->description;
        $this->type = $deduction->type;
        $this->amount = $deduction->amount;
        $this->name_function = $deduction->name_function;
        $this->institution_id = $deduction->institution_id;
        $this->area_id = $deduction->area_id;
        $this->rol_id = $deduction->rol_id;
        $this->position_id = $deduction->position_id;
        $this->worker_id = $deduction->worker_id;
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
            Deduction::find($this->editing)->update([
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
            ]);
            session()->flash('message', 'Deducción actualizada exitosamente.');
        } else {
            Deduction::create([
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
            ]);
            session()->flash('message', 'Deducción creada exitosamente.');
        }

        $this->showModal = false;
        $this->reset(['name', 'description', 'type', 'amount', 'name_function', 'institution_id', 'area_id', 'rol_id', 'position_id', 'worker_id', 'editing']);
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['name', 'description', 'type', 'amount', 'name_function', 'institution_id', 'area_id', 'rol_id', 'position_id', 'worker_id', 'editing']);
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
        $deduction = Deduction::find($id);
        if ($deduction) {
            $deduction->delete();
            session()->flash('message', 'Deducción eliminada exitosamente.');
        }
    }

    public function mount()
    {
        $this->institutionOptions = Institution::getSelectOptions();
        $this->areaOptions = Area::getSelectOptions();
        $this->rolOptions = Rol::getSelectOptions();
        $this->workerOptions = Worker::getSelectOptions();
        $this->deductionTypeOptions = Deduction::TYPES;
        $this->deductionfunctionOptions = Deduction::FUNCTIONS;
    }

    public function render()
    {
        return view('livewire.setup.index-deduction', [
            'deductions' => Deduction::query()
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
