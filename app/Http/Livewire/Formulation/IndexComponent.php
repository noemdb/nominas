<?php

namespace App\Http\Livewire\Formulation;
//livewire.formulation.index-component

use App\Http\Livewire\Common\PaginateTrait;
use App\Http\Livewire\Common\WithSortingTrait;
use App\Models\Calculation\Formulation;
// use App\Models\Formulation;
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

    public Formulation $formulation;
    public $status_delete,$authorities;

    public function edit($id)
    {
        $this->formulation = Formulation::findOrFail($id);
        // $this->resetValidation();
        $this->openModal('edit');
    }

    public function show($id)
    {
        $this->formulation = Formulation::findOrFail($id);
        // $this->resetValidation();
        $this->openModal('show');
    }

    public function save()
    {
        $data = $this->validate();

        $this->formulation->save();

        $this->formulation = New Formulation;

        $this->closeModal();

        $this->notification()->success(
            $title = 'Felicitaciones!',
            $description = 'Registro guardado exitósamente.'
        );
    }

    public function mount()
    {
        $this->formulation = New Formulation;
        $this->list_institution = Institution::list_institution(); //dd($this->list_institution);
        // $this->list_status = Formulation::list_status();
        $this->list_comment = Formulation::COLUMN_COMMENTS; //dd($this->list_comment);
    }

    public function render()
    {
        $search = $this->search;
        $formulations = Formulation::select('formulations.*')->join('institutions', 'institutions.id', '=', 'formulations.institution_id');;

        $formulations = (!empty($search)) ? $formulations->Where(
            function($query) use ($search) {
                $query->orWhere('formulations.name','like', '%'.$search.'%')
                ->orWhere('formulations.description','like','%'.$search.'%')
                ->orWhere('institutions.name','like','%'.$search.'%')
                // ->orWhere('address','like','%'.$search.'%')
                // ->orWhere('registration_number','like','%'.$search.'%')
                ;})
                : $formulations ;

        $formulations = ($this->sortBy && $this->sortDirection) ? $formulations->orderBy($this->sortBy,$this->sortDirection) : $formulations;

        $formulations = $formulations->paginate($this->paginate);

        return view('livewire.formulation.index-component',[
            'formulations' => $formulations
        ]);
    }

    public function updatedShowModal()
    {
        $this->resetValidation();
        $this->formulation = New Formulation;
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
        $this->formulation = Formulation::findOrFail($id);

        if ($this->formulation->status_delete) {
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
        $this->formulation = New Formulation;
    }

    public function delete($id)
    {
        $formulation = Formulation::findOrFail($id);

        $formulation->delete();
        $this->formulation = New Formulation;

        $this->notification([
            'title'       => 'Felicitaciones!!!',
            'description' => 'Operación realizada',
            'icon'        => 'success'
        ]);
    }


}
