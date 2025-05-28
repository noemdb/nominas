<?php

namespace App\Livewire\Setup;

use App\Models\Payroll;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\WireUiActions;

class IndexPayroll extends Component
{
    use WithPagination, WireUiActions;

    public $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $showModal = false;
    public $showCalculateModal = false;
    public $showDetailsModal = false;
    public $editing = false;
    public $payrollId = null;
    public $payrollName;
    public $dateStart;
    public $dateEnd;
    public $recalculate = false;
    public $generateReports = true;
    public $name;
    public $date_start;
    public $date_end;
    public $description;
    public $observations;
    public $status_exchange = false;
    public $status_active = true;
    public $status_public = false;
    public $status_approved = false;
    public $payroll;

    protected $rules = [
        'name' => 'required|string|max:255',
        'date_start' => 'required|date',
        'date_end' => 'required|date|after_or_equal:date_start',
        'description' => 'nullable|string',
        'observations' => 'nullable|string',
        'status_exchange' => 'boolean',
        'status_active' => 'boolean',
        'status_public' => 'boolean',
        'status_approved' => 'boolean',
    ];

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'name'],
        'sortDirection' => ['except' => 'asc'],
    ];

    public function create()
    {
        $this->resetValidation();
        $this->reset([
            'name',
            'date_start',
            'date_end',
            'description',
            'observations',
            'status_exchange',
            'status_active',
            'status_public',
            'status_approved'
        ]);
        $this->status_active = true; // Por defecto activo
        $this->editing = false;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $this->resetValidation();
        $payroll = Payroll::findOrFail($id);
        $this->editing = true;
        $this->payrollId = $id;
        $this->name = $payroll->name;
        $this->date_start = $payroll->date_start->format('Y-m-d');
        $this->date_end = $payroll->date_end->format('Y-m-d');
        $this->description = $payroll->description;
        $this->observations = $payroll->observations;
        $this->status_exchange = $payroll->status_exchange;
        $this->status_active = $payroll->status_active;
        $this->status_public = $payroll->status_public;
        $this->status_approved = $payroll->status_approved;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();
        $data = [
            'name' => $this->name,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'description' => $this->description,
            'observations' => $this->observations,
            'status_exchange' => $this->status_exchange,
            'status_active' => $this->status_active,
            'status_public' => $this->status_public,
            'status_approved' => $this->status_approved,
            'num_days' => Carbon::parse($this->date_start)->diffInDays($this->date_end) + 1,
        ];
        if ($this->editing) {
            Payroll::find($this->payrollId)->update($data);
            $this->notification()->success(
                'Nómina Actualizada',
                'La nómina ha sido actualizada correctamente.'
            );
        } else {
            Payroll::create($data);
            $this->notification()->success(
                'Nómina aperturada',
                'La nómina ha sido aperturada correctamente.'
            );
        }
        $this->showModal = false;
        $this->reset([
            'name',
            'date_start',
            'date_end',
            'description',
            'observations',
            'editing',
            'payrollId',
            'status_exchange',
            'status_active',
            'status_public',
            'status_approved'
        ]);
    }

    public function viewDetails($id)
    {
        $payroll = Payroll::findOrFail($id);
        $this->payrollId = $id;
        $this->payrollName = $payroll->name;
        $this->dateStart = $payroll->date_start;
        $this->dateEnd = $payroll->date_end;
        $this->payroll = $payroll;
        $this->showDetailsModal = true;
    }

    public function closeDetailsModal()
    {
        $this->showDetailsModal = false;
        $this->reset([
            'payrollId',
            'payrollName',
            'dateStart',
            'dateEnd',
            'payroll'
        ]);
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->showCalculateModal = false;
        $this->showDetailsModal = false;
        $this->reset([
            'name',
            'date_start',
            'date_end',
            'description',
            'observations',
            'editing',
            'status_exchange',
            'status_active',
            'status_public',
            'status_approved'
        ]);
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

    public function confirmDelete($id): void
    {
        $payroll = Payroll::findOrFail($id);
        $this->dialog()->confirm([
            'title' => '¿Eliminar Nómina?',
            'description' => "¿Está seguro de eliminar la nómina '{$payroll->name}'? Esta acción no se puede deshacer.",
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
        $payroll = Payroll::find($id);
        if ($payroll) {
            $payroll->delete();
            $this->notification()->success(
                'Nómina Eliminada',
                'La nómina ha sido eliminada correctamente.'
            );
        }
    }

    public function calculate($id)
    {
        $payroll = Payroll::findOrFail($id);
        $this->payrollId = $id;
        $this->payrollName = $payroll->name;
        $this->dateStart = $payroll->date_start;
        $this->dateEnd = $payroll->date_end;
        $this->showCalculateModal = true;
    }

    public function closeCalculateModal()
    {
        $this->showCalculateModal = false;
        $this->reset([
            'payrollId',
            'payrollName',
            'dateStart',
            'dateEnd',
            'recalculate',
            'generateReports'
        ]);
    }

    public function startCalculation()
    {
        // Aquí irá la lógica de cálculo
        // Por ahora solo mostraremos una notificación
        $this->notification()->success(
            'Cálculo Iniciado',
            'El proceso de cálculo de la nómina ha sido iniciado.'
        );

        $this->closeCalculateModal();
    }

    public function confirmClone($id): void
    {
        $payroll = Payroll::findOrFail($id);
        $this->dialog()->confirm([
            'title' => '¿Clonar Nómina?',
            'description' => "¿Está seguro de clonar la nómina '{$payroll->name}'? Se creará una nueva nómina con los mismos datos pero con estados iniciales.",
            'acceptLabel' => 'Sí, clonar',
            'rejectLabel' => 'No, cancelar',
            'method' => 'clone',
            'params' => $id,
        ]);
    }

    public function clone($id)
    {
        $payroll = Payroll::findOrFail($id);

        // Crear una nueva nómina basada en la existente
        $newPayroll = $payroll->replicate();
        $newPayroll->name = $payroll->name . ' (Copia)';
        $newPayroll->status_active = true;
        $newPayroll->status_public = false;
        $newPayroll->status_approved = false;
        $newPayroll->save();

        $this->notification()->success(
            'Nómina Clonada',
            'La nómina ha sido clonada correctamente.'
        );
    }

    public function generateStructure($id)
    {
        $payroll = Payroll::findOrFail($id);

        // Confirmar antes de proceder
        $this->dialog()->confirm([
            'title' => 'Generar Estructura de Datos',
            'description' => "¿Está seguro de generar la estructura de datos para la nómina '{$payroll->name}'? Esta acción creará registros en las tablas de conceptos y comportamientos.",
            'acceptLabel' => 'Sí, generar',
            'rejectLabel' => 'No, cancelar',
            'method' => 'confirmGenerateStructure',
            'params' => $id,
        ]);
    }

    public function confirmGenerateStructure($id)
    {
        $payroll = Payroll::findOrFail($id);
        $result = $payroll->generateDataStructure();

        if ($result['success']) {
            $this->notification()->success(
                'Estructura Generada',
                'La estructura de datos ha sido generada correctamente.'
            );
        } else {
            $this->notification()->error(
                'Error',
                $result['message']
            );
        }
    }

    public function render()
    {
        return view('livewire.setup.index-payroll', [
            'payrolls' => Payroll::query()
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
