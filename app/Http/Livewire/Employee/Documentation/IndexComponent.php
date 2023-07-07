<?php

namespace App\Http\Livewire\Employee\Documentation;
//livewire.employee.documentation.index-component

use App\Http\Livewire\Common\PaginateTrait;
use App\Http\Livewire\Common\WithSortingTrait;
use App\Models\Employee;
use App\Models\Employee\Documentation;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class IndexComponent extends Component
{
    use WithPagination;
    use Actions;

    use Rules;
    use WithSortingTrait;
    use PaginateTrait;

    use WithFileUploads;

    public $showModal = false, $modeCreate = false, $modeEdit = false, $modeShow = false, $modeShowFile = false;
    public $list_comment;
    public $list_institution,$list_employee,$list_type;
    public $list_relationship,$list_disability;

    public Documentation $documentation;
    public $status_delete,$authorities;

    public $file_image;

    public function updatedFileImage()
    {
        $this->valitateFileImage();
    }

    public function valitateFileImage()
    {
        $this->validate([
            'file_image' => 'image|max:1024',
            ],[],['file_image' => 'Archivo adjunto']);
    }

    public function uploadFile()
    {
        if ($this->file_image) {
            $this->documentation->file = ($this->file_image) ? $this->file_image->store('documentations','employees') : $this->documentation->file;
            $this->file_image = null;
        }
    }

    public function edit($id)
    {
        $this->documentation = Documentation::findOrFail($id);
        $this->openModal('edit');
        $this->file_image = null;
    }

    public function show($id)
    {
        $this->documentation = Documentation::findOrFail($id);
        $this->openModal('show');
    }

    public function showFile($id)
    {
        $this->documentation = Documentation::findOrFail($id);
        if ($this->documentation->file_exist) {
            $this->openModal('showFile');
        }

    }

    public function save()
    {
        $this->valitateFileImage();

        $data = $this->validate();

        $this->uploadFile();

        $this->documentation->save();

        $this->documentation = New Documentation;

        $this->closeModal();

        $this->notification()->success(
            $title = 'Felicitaciones!',
            $description = 'Registro guardado exitósamente.'
        );
    }

    public function mount()
    {
        $this->documentation = New Documentation;
        $this->list_employee = Employee::list_employee();
        $this->list_type = Documentation::list_type();
        $this->list_comment = Documentation::COLUMN_COMMENTS;
        $this->file_image = null;
    }

    public function render()
    {
        $search = $this->search;
        $documentations = Documentation::select('documentations.*','employees.name as employee_name','employees.ci as employee_ci')
        ->join('employees', 'employees.id', '=', 'documentations.employee_id');
        $documentations = (!empty($search)) ? $documentations->Where(
            function($query) use ($search) {
                $query->orWhere('employees.name','like', '%'.$search.'%')
                ->orWhere('employees.ci','like','%'.$search.'%')
                ->orWhere('documentations.name','like','%'.$search.'%')
                ->orWhere('documentations.description','like','%'.$search.'%')
                ->orWhere('documentations.provider','like','%'.$search.'%')
                ;})
                : $documentations ; /* 'employee_name','name','description','provider','location','duration_hours' */

        $documentations = ($this->sortBy && $this->sortDirection) ? $documentations->orderBy($this->sortBy,$this->sortDirection) : $documentations;

        $documentations = $documentations->paginate($this->paginate);

        return view('livewire.employee.documentation.index-component',[
            'documentations' => $documentations
        ]);
    }

    public function updatedShowModal()
    {
        $this->resetValidation();
        $this->documentation = New Documentation;
    }

    public function openModal($mode)
    {
        $this->showModal = true;
        $this->modeCreate = ($mode=='create') ? true : false ;
        $this->modeEdit = ($mode=='edit') ? true : false ;
        $this->modeShow = ($mode=='show') ? true : false ;
        $this->modeShowFile = ($mode=='showFile') ? true : false ;
        $this->resetValidation();
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function deleteQuestion($id)
    {
        $this->documentation = Documentation::findOrFail($id);
        if ($this->documentation->status_delete) {
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
        $this->documentation = New Documentation;
    }

    public function delete($id)
    {
        $documentation = Documentation::findOrFail($id);

        $documentation->delete();
        $this->documentation = New Documentation;

        $this->notification([
            'title'       => 'Felicitaciones!!!',
            'description' => 'Operación realizada',
            'icon'        => 'success'
        ]);
    }


}
