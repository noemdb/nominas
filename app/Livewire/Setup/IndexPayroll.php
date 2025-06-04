<?php

namespace App\Livewire\Setup;

use App\Models\Payroll;
use App\Models\PayrollWorkerDetail;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\WireUiActions;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PayrollDetailsExport;
use Illuminate\Support\Facades\Log;

class IndexPayroll extends Component
{
    use WithPagination, WireUiActions;

    public $search = '';
    public $dateStartFilter = '';
    public $dateEndFilter = '';
    public $currencyFilter = '';
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
    public $num_days = 15;
    public $description;
    public $observations;
    public $status_exchange = false;
    public $status_active = true;
    public $status_public = false;
    public $status_approved = false;
    public $payroll;
    public $showReportsModal = false;
    public $selectedPayroll = null;
    public $selectedDetail = null;
    public $payrollDetails = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'date_start' => 'required|date',
        'date_end' => 'required|date|after_or_equal:date_start',
        'num_days' => 'required|integer|min:1|max:31',
        'description' => 'nullable|string',
        'observations' => 'nullable|string',
        'status_exchange' => 'boolean',
        'status_active' => 'boolean',
        'status_public' => 'boolean',
        'status_approved' => 'boolean',
    ];

    protected $queryString = [
        'search' => ['except' => ''],
        'dateStartFilter' => ['except' => ''],
        'dateEndFilter' => ['except' => ''],
        'currencyFilter' => ['except' => ''],
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
        $this->num_days = 15;
        $this->status_active = true;
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
        $this->num_days = $payroll->num_days;
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
            'num_days' => $this->num_days,
            'description' => $this->description,
            'observations' => $this->observations,
            'status_exchange' => $this->status_exchange,
            'status_active' => $this->status_active,
            'status_public' => $this->status_public,
            'status_approved' => $this->status_approved,
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
            'num_days',
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
        $this->showCalculateModal = false;
        $this->showDetailsModal = false;
        $this->showReportsModal = false;
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
        $this->showReportsModal = false;
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
        try {
            $payroll = Payroll::findOrFail($this->payrollId);

            // Registrar detalles del período laboral
            $result = $payroll->registerWorkerPeriodDetails();

            if (!$result['success']) {
                throw new \Exception($result['message']);
            }

            $this->notification()->success(
                'Cálculo Iniciado',
                $result['message']
            );

            $this->closeCalculateModal();
        } catch (\Exception $e) {
            $this->notification()->error(
                'Error en el Cálculo',
                'No se pudo iniciar el cálculo: ' . $e->getMessage()
            );
        }
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
        $result = $payroll->clonePayrollStructure();

        if ($result['success']) {
            $this->notification()->success(
                'Nómina Clonada',
                $result['message']
            );
        } else {
            $this->notification()->error(
                'Error',
                $result['message']
            );
        }
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

    public function confirmClearStructure($id): void
    {
        $payroll = Payroll::findOrFail($id);
        $this->dialog()->confirm([
            'title' => 'Limpiar Estructura de Datos',
            'description' => "¿Está seguro de limpiar la estructura de datos de la nómina '{$payroll->name}'? Esta acción eliminará todos los conceptos asociados y no se puede deshacer.",
            'acceptLabel' => 'Sí, limpiar',
            'rejectLabel' => 'No, cancelar',
            'method' => 'clearStructure',
            'params' => $id,
            'accept' => [
                'label' => 'Sí, limpiar',
                'color' => 'negative'
            ],
            'reject' => [
                'label' => 'No, cancelar',
                'color' => 'gray'
            ]
        ]);
    }

    public function clearStructure($id)
    {
        $payroll = Payroll::findOrFail($id);
        $result = $payroll->clearPayrollConcepts();

        if ($result['success']) {
            $this->notification()->success(
                'Estructura Limpiada',
                'La estructura de datos ha sido limpiada correctamente.'
            );
        } else {
            $this->notification()->error(
                'Error',
                $result['message']
            );
        }
    }

    public function clearFilters()
    {
        $this->reset([
            'search',
            'dateStartFilter',
            'dateEndFilter',
            'currencyFilter'
        ]);
    }

    public function confirmDeletePayroll($id): void
    {
        $payroll = Payroll::findOrFail($id);
        $this->dialog()->confirm([
            'title' => '¿Eliminar Nómina?',
            'description' => "¿Está seguro de eliminar la nómina '{$payroll->name}'? Esta acción eliminará permanentemente la nómina y todos sus datos asociados (conceptos, comportamientos, historiales). Esta acción no se puede deshacer.",
            'acceptLabel' => 'Sí, eliminar',
            'rejectLabel' => 'No, cancelar',
            'method' => 'deletePayroll',
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

    public function deletePayroll($id)
    {
        try {
            $payroll = Payroll::findOrFail($id);

            // Primero limpiar la estructura de datos
            $result = $payroll->clearPayrollConcepts();
            if (!$result['success']) {
                throw new \Exception($result['message']);
            }

            // Luego eliminar la nómina
            $payroll->delete();

            $this->notification()->success(
                'Nómina Eliminada',
                'La nómina y todos sus datos asociados han sido eliminados correctamente.'
            );
        } catch (\Exception $e) {
            $this->notification()->error(
                'Error',
                'No se pudo eliminar la nómina: ' . $e->getMessage()
            );
        }
    }

    public function showReports($payrollId)
    {
        try {
            // Cargar la nómina con sus relaciones básicas
            $this->selectedPayroll = Payroll::findOrFail($payrollId);

            // Cargar los detalles con todas las relaciones necesarias
            $this->payrollDetails = PayrollWorkerDetail::with([
                'worker',
                'position.rol',
                'position.area',
                'bonuses' => function ($query) {
                    $query->where('status_active', true)
                        ->with('bonus');
                },
                'deductions' => function ($query) {
                    $query->where('status_active', true)
                        ->with('deduction');
                },
                'discounts' => function ($query) {
                    $query->where('status_active', true)
                        ->with('discount');
                }
            ])

                ->where('payroll_id', $payrollId)
                ->where('status_active', true)
                ->get();

            $this->showReportsModal = true;
        } catch (\Exception $e) {
            $this->notification()->error(
                'Error',
                'No se pudieron cargar los reportes: ' . $e->getMessage()
            );
            $this->closeReportsModal();
        }
    }

    public function closeReportsModal()
    {
        $this->showReportsModal = false;
        $this->selectedPayroll = null;
        $this->selectedDetail = null;
        $this->selectedDetail = null;
        $this->payrollDetails = [];
    }

    public function viewWorkerDetail($detailId)
    {
        $this->selectedDetail = PayrollWorkerDetail::with(['worker', 'position.area', 'position.rol'])
            ->findOrFail($detailId);
    }

    public function exportToExcel($payrollId)
    {
        try {
            if (!$payrollId) {
                $this->notification()->error(
                    'Error al exportar',
                    'No se ha seleccionado una nómina para exportar.'
                );
                return;
            }

            // Verificar que la nómina existe y está activa
            $payroll = Payroll::findOrFail($payrollId);

            if (!$payroll->status_active) {
                $this->notification()->error(
                    'Error al exportar',
                    'La nómina seleccionada está inactiva.'
                );
                return;
            }

            // Verificar que hay detalles para exportar
            $detailsCount = PayrollWorkerDetail::where('payroll_id', $payroll->id)
                ->where('status_active', true)
                ->count();

            if ($detailsCount === 0) {
                $this->notification()->error(
                    'Error al exportar',
                    'No hay detalles activos para exportar en esta nómina.'
                );
                return;
            }

            // Exportar usando el exportador
            return Excel::download(
                new PayrollDetailsExport($payroll),
                'nomina_' . $payroll->name . '_' . now()->format('Y-m-d') . '.xlsx'
            );
        } catch (\Exception $e) {
            Log::error('Error en exportToExcel', [
                'error' => $e->getMessage(),
                'payroll_id' => $payrollId,
                'trace' => $e->getTraceAsString()
            ]);

            $this->notification()->error(
                'Error al exportar',
                'Error al exportar la nómina: ' . $e->getMessage()
            );
        }
    }

    public function closeWorkerDetail()
    {
        $this->selectedDetail = null;
    }

    public function render()
    {
        return view('livewire.setup.index-payroll', [
            'payrolls' => Payroll::query()
                ->when($this->search, function ($query) {
                    $query->where(function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('description', 'like', '%' . $this->search . '%');
                    });
                })
                ->when($this->dateStartFilter, function ($query) {
                    $query->where('date_start', '>=', $this->dateStartFilter);
                })
                ->when($this->dateEndFilter, function ($query) {
                    $query->where('date_end', '<=', $this->dateEndFilter);
                })
                ->when($this->currencyFilter !== null && $this->currencyFilter !== '', function ($query) {
                    $query->where('status_exchange', $this->currencyFilter);
                })
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10),
            'sortField' => $this->sortField,
            'sortDirection' => $this->sortDirection
        ]);
    }
}
