<?php

namespace App\Http\Livewire\Employee\Position;

use App\Http\Livewire\Common\PaginateTrait;
use App\Http\Livewire\Common\WithSortingTrait;
use App\Models\Employee;
use App\Models\Employee\Position;
use App\Models\Institution;
use App\Models\Institution\Area;
use App\Models\Institution\Rol;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

/*
public function render()
{
    return view('livewire.personal.personal.index-component');
}
*/

class IndexComponent extends Component
{
    use WithPagination;
    use Actions;

    use Rules;
    use WithSortingTrait;
    use PaginateTrait;

    public $showModal = false, $modeCreate = false, $modeEdit = false, $modeShow = false;
    public $list_comment;
    public $list_institution,$list_employee,$list_frequency_workday,$list_contract_type;
    public $list_area,$list_rol;

    public Position $position;
    public $status_delete,$authorities;

    public function edit($id)
    {
        $this->position = Position::findOrFail($id);
        $this->openModal('edit');
    }

    public function show($id)
    {
        $this->position = Position::findOrFail($id);
        $this->openModal('show');
    }

    public function save()
    {
        $data = $this->validate();

        $this->position->save();

        $this->position = New Position;

        $this->closeModal();

        $this->notification()->success(
            $title = 'Felicitaciones!',
            $description = 'Registro guardado exitósamente.'
        );
    }

    public function mount()
    {
        $this->position = New Position;
        $this->list_employee = Employee::list_employee();
        $this->list_frequency_workday = Position::list_frequency_workday();
        $this->list_contract_type = Position::list_contract_type();
        // $this->list_employee = Collect();
        $this->list_area = Area::list_area();
        $this->list_rol = Rol::list_rol();
        $this->list_comment = Position::COLUMN_COMMENTS; //dd($this->list_comment);
    }

    public function render()
    {
        $search = $this->search;
        $positions = Position::select('positions.*','employees.name as employee_name','employees.ci as employee_ci')
        ->join('employees', 'employees.id', '=', 'positions.employee_id');
        $positions = (!empty($search)) ? $positions->Where(
            function($query) use ($search) {
                $query->orWhere('employees.name','like', '%'.$search.'%')
                ->orWhere('employees.ci','like','%'.$search.'%')
                ->orWhere('positions.description','like','%'.$search.'%')
                ;})
                : $positions ;

        $positions = ($this->sortBy && $this->sortDirection) ? $positions->orderBy($this->sortBy,$this->sortDirection) : $positions;

        $positions = $positions->paginate($this->paginate);

        return view('livewire.employee.position.index-component',[
            'positions' => $positions
        ]);
    }

    public function updatedShowModal()
    {
        $this->resetValidation();
        $this->position = New Position;
    }

    public function openModal($mode)
    {
        $this->showModal = true;
        $this->modeCreate = ($mode=='create') ? true : false ;
        $this->modeEdit = ($mode=='edit') ? true : false ;
        $this->modeShow = ($mode=='show') ? true : false ;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function deleteQuestion($id)
    {
        $this->position = Position::findOrFail($id);

        if ($this->position->status_delete) {
            $this->notification()->confirm([
                'title'       => 'Estas seguro que desea realizar esta operación?',
                'description' => 'Eliminar registro?',
                'icon'        => 'question',
                'closeButton'        => true,
                'accept'      => [
                    'label'  => 'Aceptar',
                    'method' => 'delete',
                    'params' => $id,
                ],
                'reject' => [
                    'label'  => 'No, cancelar',
                    'method' => 'cancel',
                ],
            ]);
        } else {
            $this->notification()->error(
                $title = 'Error!, Esta operación no se puede realizar.',
                $description = 'Este registro tiene asociado otros, en caso de borrar, se pierde también los registro asociados.'
            );
        }

    }

    public function cancel()
    {
        $this->notification([
            'title'       => 'Has cancelado!',
            'description' => 'Ningún cambio realizado',
            'icon'        => 'info'
        ]);
        $this->position = New Position;
    }

    public function delete($id)
    {
        $position = Position::findOrFail($id);

        $position->delete();
        $this->position = New Position;

        $this->notification([
            'title'       => 'Felicitaciones!!!',
            'description' => 'Operación realizada',
            'icon'        => 'success'
        ]);
    }


}
