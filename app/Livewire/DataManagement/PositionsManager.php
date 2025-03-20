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
    public $selected_worker,$selected_worker_id, $activePosition = null;

    public $isOpenPosition = false; // Para controlar el modal
    public $isEditPosition = false; // Para diferenciar entre crear y editar

    protected $rules = [
        'start_date' => 'required|date',
        'end_date' => 'nullable|date|after:start_date',
        'observations' => 'nullable|string',
        'is_active' => 'boolean',
        'area_id' => 'required|exists:areas,id',
        'rol_id' => 'required|exists:rols,id',
        'worker_id' => 'required|exists:workers,id',
    ];

    public function mount($worker_id = null)
    {
        $this->areas = Area::all();
        $this->rols = Rol::all();
        $this->workers = Worker::all();

        // Asignar el worker_id recibido como parámetro
        $this->selected_worker = Worker::find($worker_id);
        $this->selected_worker_id = ($this->selected_worker) ? $worker_id : null;
    }

    public function render()
    {
        // Filtrar las posiciones por el worker_id seleccionado
        $query = Position::with(['area', 'rol', 'worker']);

        if ($this->selected_worker_id) {
            $query->where('worker_id', $this->selected_worker_id);
        }

        $positions = $query->paginate(10);

        return view('livewire.data-management.positions-manager',[
            'positions' => $positions
        ]);        
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
        $position = Position::findOrFail($id); //dd($position);
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
        $this->validate(); 
        $arr = [
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'observations' => $this->observations,
            'is_active' => $this->is_active,
            'area_id' => $this->area_id,
            'rol_id' => $this->rol_id,
            'worker_id' => $this->worker_id,
        ]; //dd($arr);

        try {
            if ($this->isEditPosition) {
                $position = Position::where('id', $this->position_id)->update($arr);
            } else {
                $position = Position::create($arr);
            }
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        // dd($position);

        $this->resetInputFieldsPosition();
        $this->successNotification();
        $this->resetErrorBag();
        $this->closeModalPosition();
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
