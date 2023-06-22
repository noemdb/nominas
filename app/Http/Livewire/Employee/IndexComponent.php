<?php

namespace App\Http\Livewire\Employee;

use App\Http\Livewire\Common\PaginateTrait;
use App\Http\Livewire\Common\WithSortingTrait;
use App\Models\Employee;
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
    public $list_institution;
    public $list_status;

    public Employee $employee;
    public $status_delete,$authorities;

    public function edit($id)
    {
        $this->employee = Employee::findOrFail($id);
        // $this->resetValidation();
        $this->openModal('edit');
    }

    public function show($id)
    {
        $this->employee = Employee::findOrFail($id);
        // $this->resetValidation();
        $this->openModal('show');
    }

    public function save()
    {
        $data = $this->validate();

        $this->employee->save();

        $this->employee = New Employee;

        $this->closeModal();

        $this->notification()->success(
            $title = 'Felicitaciones!',
            $description = 'Registro guardado exitósamente.'
        );
    }

    public function mount()
    {
        $this->employee = New Employee;
        $this->list_institution = Institution::list_institution(); //dd($this->list_institution);
        $this->list_status = Employee::list_status();
        $this->list_comment = Employee::COLUMN_COMMENTS; //dd($this->list_comment);
    }

    public function render()
    {
        $search = $this->search;
        $employees = Employee::select('employees.*');

        $employees = (!empty($search)) ? $employees->Where(
            function($query) use ($search) {
                $query->orWhere('name','like', '%'.$search.'%')
                ->orWhere('ci','like','%'.$search.'%')
                // ->orWhere('address','like','%'.$search.'%')
                // ->orWhere('registration_number','like','%'.$search.'%')
                ;})
                : $employees ;

        $employees = ($this->sortBy && $this->sortDirection) ? $employees->orderBy($this->sortBy,$this->sortDirection) : $employees;

        $employees = $employees->paginate($this->paginate);

        return view('livewire.employee.index-component',[
            'employees' => $employees
        ]);
    }

    public function updatedShowModal()
    {
        $this->resetValidation();
        $this->employee = New Employee;
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
        $this->employee = Employee::findOrFail($id);

        if ($this->employee->status_delete) {
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
        $this->employee = New Employee;
    }

    public function delete($id)
    {
        $employee = Employee::findOrFail($id);

        $employee->delete();
        $this->employee = New Employee;

        $this->notification([
            'title'       => 'Felicitaciones!!!',
            'description' => 'Operación realizada',
            'icon'        => 'success'
        ]);
    }


}
