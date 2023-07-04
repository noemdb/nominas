<?php

namespace App\Http\Livewire\Employee\Training;
//livewire.employee.training.index-component

use App\Http\Livewire\Common\PaginateTrait;
use App\Http\Livewire\Common\WithSortingTrait;
use App\Models\Employee;
use App\Models\Employee\Training;
use App\Models\Institution;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class IndexComponent extends Component
{
    use WithPagination;
    use Actions;

    use Rules;
    use WithSortingTrait;
    use PaginateTrait;

    public $showModal = false, $modeCreate = false, $modeEdit = false, $modeShow = false;
    public $list_comment;
    public $list_institution,$list_employee;
    public $list_relationship,$list_disability;

    public Training $training;
    public $status_delete,$authorities;

    public function edit($id)
    {
        $this->training = Training::findOrFail($id);
        $this->openModal('edit');
    }

    public function show($id)
    {
        $this->training = Training::findOrFail($id);
        $this->openModal('show');
    }

    public function save()
    {
        $data = $this->validate();

        $this->training->save();

        $this->training = New Training;

        $this->closeModal();

        $this->notification()->success(
            $title = 'Felicitaciones!',
            $description = 'Registro guardado exitósamente.'
        );
    }

    public function mount()
    {
        $this->training = New Training;
        $this->list_employee = Employee::list_employee();
        $this->list_comment = Training::COLUMN_COMMENTS;
    }

    public function render()
    {
        $search = $this->search;
        $trainings = Training::select('trainings.*','employees.name as employee_name','employees.ci as employee_ci')
        ->join('employees', 'employees.id', '=', 'trainings.employee_id');
        $trainings = (!empty($search)) ? $trainings->Where(
            function($query) use ($search) {
                $query->orWhere('employees.name','like', '%'.$search.'%')
                ->orWhere('employees.ci','like','%'.$search.'%')
                ->orWhere('trainings.name','like','%'.$search.'%')
                ->orWhere('trainings.description','like','%'.$search.'%')
                ->orWhere('trainings.provider','like','%'.$search.'%')
                ;})
                : $trainings ; /* 'employee_name','name','description','provider','location','duration_hours' */

        $trainings = ($this->sortBy && $this->sortDirection) ? $trainings->orderBy($this->sortBy,$this->sortDirection) : $trainings;

        $trainings = $trainings->paginate($this->paginate);

        return view('livewire.employee.training.index-component',[
            'trainings' => $trainings
        ]);
    }

    public function updatedShowModal()
    {
        $this->resetValidation();
        $this->training = New Training;
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
        $this->training = Training::findOrFail($id);

        if ($this->training->status_delete) {
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
        $this->training = New Training;
    }

    public function delete($id)
    {
        $training = Training::findOrFail($id);

        $training->delete();
        $this->training = New Training;

        $this->notification([
            'title'       => 'Felicitaciones!!!',
            'description' => 'Operación realizada',
            'icon'        => 'success'
        ]);
    }


}
