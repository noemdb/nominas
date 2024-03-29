<?php

namespace App\Http\Livewire\Institution;
// touch 'app/Http/Livewire/Institution/InstitutionRules.php'
// touch 'app/Http/Livewire/Common/PaginateTrait.php'
// touch 'app/Http/Livewire/Common/FilterTrait.php'

use App\Http\Livewire\Common\PaginateTrait;
use App\Http\Livewire\Common\WithSortingTrait;
use App\Models\Institution;
use Livewire\Component;

use Livewire\WithPagination;

use WireUi\Traits\Actions;

class IndexComponent extends Component
{
    use WithPagination;
    use Actions;

    use InstitutionRules;
    use WithSortingTrait;
    use PaginateTrait;

    public $showModal = false, $modeCreate = false, $modeEdit = false, $modeShow = false;
    public $list_comment;
    public $list_type;
    public $list_legal_status;

    public Institution $institution;
    public $status_delete,$authorities;

    public function edit($id)
    {
        $this->institution = Institution::findOrFail($id);
        $this->openModal('edit');
    }

    public function show($id)
    {
        $this->institution = Institution::findOrFail($id);
        $this->openModal('show');
    }

    public function save()
    {
        $data = $this->validate();

        $this->institution->save();

        $this->institution = New Institution;

        $this->closeModal();

        $this->notification()->success(
            $title = 'Felicitaciones!',
            $description = 'Registro guardado exitósamente.'
        );
    }

    public function mount()
    {
        $this->institution = New Institution;
        $this->list_type = Institution::list_type();
        $this->list_legal_status = Institution::list_legal_status();
        $this->list_comment = Institution::COLUMN_COMMENTS;
    }

    public function render()
    {
        $search = $this->search;
        $institutions = Institution::select('institutions.*');

        $institutions = (!empty($search)) ? $institutions->Where(
            function($query) use ($search) {
                $query->orWhere('name','like', '%'.$search.'%')
                ->orWhere('type','like','%'.$search.'%')
                ->orWhere('address','like','%'.$search.'%')
                ->orWhere('registration_number','like','%'.$search.'%')
                ;})
                : $institutions ;

        $institutions = ($this->sortBy && $this->sortDirection) ? $institutions->orderBy($this->sortBy,$this->sortDirection) : $institutions;

        $institutions = $institutions->paginate($this->paginate);

        return view('livewire.institution.index-component',[
            'institutions' => $institutions
        ]);
    }

    public function updatedShowModal()
    {
        $this->institution = New Institution;
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
        $this->institution = Institution::findOrFail($id);

        if ($this->institution->status_delete) {
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
        $this->institution = New Institution;
    }

    public function delete($id)
    {
        $institution = Institution::findOrFail($id);

        $institution->delete();
        $this->institution = New Institution;

        $this->notification([
            'title'       => 'Felicitaciones!!!',
            'description' => 'Operación realizada',
            'icon'        => 'success'
        ]);
    }


}
