<?php

namespace App\Http\Livewire\Employee\Personal;

use App\Http\Livewire\Common\PaginateTrait;
use App\Http\Livewire\Common\WithSortingTrait;
use App\Models\Employee;
use App\Models\Employee\Personal;
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

    public Personal $personal;
    public $status_delete,$authorities;

    public function edit($id)
    {
        $this->personal = Personal::findOrFail($id);
        // $this->resetValidation();
        $this->openModal('edit');
    }

    public function show($id)
    {
        $this->personal = Personal::findOrFail($id);
        // $this->resetValidation();
        $this->openModal('show');
    }

    public function save()
    {
        $data = $this->validate();

        $this->personal->save();

        $this->personal = New Personal;

        $this->closeModal();

        $this->notification()->success(
            $title = 'Felicitaciones!',
            $description = 'Registro guardado exitósamente.'
        );
    }

    public function mount()
    {
        $this->personal = New Personal;
        $this->list_institution = Institution::list_institution(); //dd($this->list_institution);
        // $this->list_employee = Employee::list_employee();
        $this->list_employee = Collect();
        $this->list_relationship = Personal::list_relationship();
        $this->list_disability = Personal::list_disability();
        $this->list_comment = Personal::COLUMN_COMMENTS; //dd($this->list_comment);
    }

    public function render()
    {
        $search = $this->search;
        $personals = Personal::select('personals.*','employees.name as employee_name','employees.ci as employee_ci')
        ->join('employees', 'employees.id', '=', 'personals.employee_id');
        $personals = (!empty($search)) ? $personals->Where(
            function($query) use ($search) {
                $query->orWhere('employees.name','like', '%'.$search.'%')
                ->orWhere('employees.ci','like','%'.$search.'%')
                ->orWhere('personals.address','like','%'.$search.'%')
                // ->orWhere('address','like','%'.$search.'%')
                // ->orWhere('registration_number','like','%'.$search.'%')
                ;})
                : $personals ;

        $personals = ($this->sortBy && $this->sortDirection) ? $personals->orderBy($this->sortBy,$this->sortDirection) : $personals;

        $personals = $personals->paginate($this->paginate);

        return view('livewire.employee.personal.index-component',[
            'personals' => $personals
        ]);
    }

    public function updatedShowModal()
    {
        $this->resetValidation();
        $this->personal = New Personal;
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
        $this->personal = Personal::findOrFail($id);

        if ($this->personal->status_delete) {
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
        $this->personal = New Personal;
    }

    public function delete($id)
    {
        $personal = Personal::findOrFail($id);

        $personal->delete();
        $this->personal = New Personal;

        $this->notification([
            'title'       => 'Felicitaciones!!!',
            'description' => 'Operación realizada',
            'icon'        => 'success'
        ]);
    }


}
