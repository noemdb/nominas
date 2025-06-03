<?php

namespace App\Livewire\Comportamiento;

use App\Models\Payroll;
use App\Models\Worker;
use App\Models\WorkerBehavior;
// use App\Models\WorkerBehavior;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\WireUiActions;
use App\Traits\Loggable;

class BehaviorsManager extends Component
{
    use WithPagination;
    use WireUiActions;
    use Loggable;

    public $search = '';
    public $perPage = 10;
    public $sortField = 'date';
    public $sortDirection = 'desc';
    public $filterPayrollId = null;
    public $filterStatus = null;
    public $payrollOptions = [];
    public $workerOptions = [];

    public $showModal = false;
    public $isEdit = false;
    public $behaviorId = null;

    public $confirmingDelete = false;
    public $deleteId = null;

    public $isLoaded = false;

    public $behavior = [
        'worker_id' => '',
        'date' => '',
        'attendance_days' => 0,
        'absences' => 0,
        'permissions' => 0,
        'delays' => 0,
        'labor_hours' => 0,
        'administrative_hours' => 0,
        'medical_rest_days' => 0,
        'medical_rest_hours' => 0,
        'paid_permission_days' => 0,
        'paid_permission_hours' => 0,
        'unpaid_permission_days' => 0,
        'unpaid_permission_hours' => 0,
        'unjustified_absence_days' => 0,
        'unjustified_absence_hours' => 0,
        'observations' => '',
        'bonus' => 0,
        'discount' => 0,
        'status' => 'pending'
    ];

    public $showDetailsModal = false;
    public $selectedBehavior = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'date'],
        'sortDirection' => ['except' => 'desc'],
        'filterPayrollId' => ['except' => null],
        'filterStatus' => ['except' => null],
    ];

    public function mount()
    {
        $this->payrollOptions = Payroll::getSelectOptions();
        $this->workerOptions = Worker::getSelectOptions();
    }

    public function setLoaded()
    {
        $this->isLoaded = true;
        $this->dispatch('component-loaded');
    }

    protected function rules()
    {
        return [
            'behavior.worker_id' => 'required|exists:workers,id',
            'behavior.date' => 'required|date',
            'behavior.attendance_days' => 'required|integer|min:0',
            'behavior.absences' => 'required|integer|min:0',
            'behavior.permissions' => 'required|integer|min:0',
            'behavior.delays' => 'required|integer|min:0',
            'behavior.labor_hours' => 'required|numeric|min:0',
            'behavior.administrative_hours' => 'required|numeric|min:0',
            'behavior.medical_rest_days' => 'required|integer|min:0',
            'behavior.medical_rest_hours' => 'required|numeric|min:0',
            'behavior.paid_permission_days' => 'required|integer|min:0',
            'behavior.paid_permission_hours' => 'required|numeric|min:0',
            'behavior.unpaid_permission_days' => 'required|integer|min:0',
            'behavior.unpaid_permission_hours' => 'required|numeric|min:0',
            'behavior.unjustified_absence_days' => 'required|integer|min:0',
            'behavior.unjustified_absence_hours' => 'required|numeric|min:0',
            'behavior.observations' => 'nullable|string',
            'behavior.bonus' => 'required|numeric|min:0',
            'behavior.discount' => 'required|numeric|min:0',
            'behavior.status' => 'required|in:pending,approved,rejected'
        ];
    }

    public function create()
    {
        $this->reset(['behavior', 'behaviorId', 'isEdit']);
        $this->behavior = [
            'worker_id' => '',
            'date' => now()->format('Y-m-d'),
            'attendance_days' => 0,
            'absences' => 0,
            'permissions' => 0,
            'delays' => 0,
            'labor_hours' => 0,
            'administrative_hours' => 0,
            'medical_rest_days' => 0,
            'medical_rest_hours' => 0,
            'paid_permission_days' => 0,
            'paid_permission_hours' => 0,
            'unpaid_permission_days' => 0,
            'unpaid_permission_hours' => 0,
            'unjustified_absence_days' => 0,
            'unjustified_absence_hours' => 0,
            'observations' => '',
            'bonus' => 0,
            'discount' => 0,
            'status' => 'pending'
        ];
        $this->isEdit = false;
        $this->showModal = true;
        $this->resetErrorBag();
    }

    public function edit($id)
    {
        $this->behaviorId = $id;
        $this->isEdit = true;

        $behaviorModel = WorkerBehavior::findOrFail($id);
        $this->behavior = $behaviorModel->toArray();
        $this->behavior['date'] = $behaviorModel->date->format('Y-m-d');

        $this->showModal = true;
        $this->resetErrorBag();
    }

    public function save()
    {
        $this->validate();

        if ($this->isEdit) {
            $behaviorModel = WorkerBehavior::findOrFail($this->behaviorId);
            $oldData = $behaviorModel->toArray();
        } else {
            $behaviorModel = new WorkerBehavior();
        }

        $behaviorModel->fill($this->behavior);

        try {
            $behaviorModel->save();

            if ($this->isEdit) {
                $this->logUpdate($oldData, $behaviorModel->toArray());
            } else {
                $this->logCreation($behaviorModel->toArray());
            }

            $this->reset(['behavior', 'behaviorId', 'isEdit', 'showModal']);
            $this->successNotification();
            $this->resetErrorBag();
        } catch (\Exception $e) {
            $this->logError('Error al guardar comportamiento: ' . $e->getMessage(), [
                'behavior_data' => $this->behavior
            ]);
            throw $e;
        }
    }

    public function confirmDelete($id)
    {
        $this->confirmingDelete = true;
        $this->deleteId = $id;
    }

    public function deleteBehavior()
    {
        try {
            $behavior = WorkerBehavior::findOrFail($this->deleteId);
            $behaviorData = $behavior->toArray();
            $behavior->delete();

            $this->logDeletion($behaviorData);
            $this->confirmingDelete = false;
            $this->deleteId = null;
            $this->successNotification();
        } catch (\Exception $e) {
            $this->logError('Error al eliminar comportamiento: ' . $e->getMessage(), [
                'behavior_id' => $this->deleteId
            ]);
            throw $e;
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->showDetailsModal = false;
        $this->confirmingDelete = false;
        $this->resetErrorBag();
    }

    public function render()
    {
        $query = WorkerBehavior::with(['worker'])
            ->when($this->search, function ($query) {
                $searchTerms = explode(' ', $this->search);
                $query->where(function ($q) use ($searchTerms) {
                    foreach ($searchTerms as $term) {
                        $q->where(function ($subQuery) use ($term) {
                            $subQuery->whereHas('worker', function ($q) use ($term) {
                                $q->where('first_name', 'like', "%{$term}%")
                                    ->orWhere('last_name', 'like', "%{$term}%")
                                    ->orWhere('identification', 'like', "%{$term}%");
                            })
                                ->orWhere('date', 'like', "%{$term}%")
                                ->orWhere('status', 'like', "%{$term}%");
                        });
                    }
                });
            })
            ->when($this->filterPayrollId, function ($query) {
                $query->whereHas('payrolls', function ($q) {
                    $q->where('payrolls.id', $this->filterPayrollId);
                });
            })
            ->when($this->filterStatus, function ($query) {
                $query->where('status', $this->filterStatus);
            });

        $query->orderBy($this->sortField, $this->sortDirection);

        return view('livewire.comportamiento.behaviors-manager', [
            'behaviors' => $query->paginate($this->perPage),
            'workers' => Worker::where('is_active', true)->get()
        ]);
    }

    public function updatingPerPage()
    {
        $this->resetPage();
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

    public function clearSearch()
    {
        $this->search = '';
    }

    public function successNotification(): void
    {
        $this->notification()->send([
            'icon' => 'success',
            'title' => 'Realizado!',
            'description' => 'Acción ejecutada correctamente.',
        ]);
    }

    public function showDetails($behaviorId)
    {
        $this->selectedBehavior = WorkerBehavior::with(['worker', 'approver'])->find($behaviorId);
        $this->showDetailsModal = true;
    }

    public function closeDetailsModal()
    {
        $this->showDetailsModal = false;
        $this->selectedBehavior = null;
    }
}
