<?php

namespace App\Http\Livewire\Institution\Autority;
// touch 'app/Http/Livewire/Institution/AutorityRules.php'
// touch 'app/Http/Livewire/Common/WithSortingTrait.php'

use App\Http\Livewire\Common\WithSortingTrait;
use App\Http\Livewire\Institution\Autority\AuthorityRules;
use App\Models\Institution\Authority;
use Livewire\Component;
use WireUi\Traits\Actions;

class IndexComponent extends Component
{
    use AuthorityRules;
    use WithSortingTrait;
    use Actions;

    public Authority $authority;
    public $list_comment;
    public $showModal = false;
    public $list_institution;

    public function mount()
    {
        $this->authority = new Authority;
        $this->list_institution = Authority::list_institution();
        $this->list_comment = Authority::COLUMN_COMMENTS;
    }

    public function render()
    {
        $authorities = Authority::all();
        return view('livewire.institution.autority.index-component', ['authorities' => $authorities]);
    }

    public function save()
    {
        $this->validate();
        $this->authority->save();
        $this->authority = new Authority;
        $this->showModal = false;
        $this->notification()->success(
            $title = 'Felicitaciones!',
            $description = 'Registro guardado exitósamente.'
        );
    }

    public function edit($id)
    {
        $this->authority = Authority::findOrFail($id);
        $this->showModal = true;
    }

    public function delete($id)
    {
        $authority = Authority::findOrFail($id);

        $authority->delete();
        $this->authority = new Authority;

        $this->notification([
            'title'       => 'Felicitaciones!!!',
            'description' => 'Operación realizada',
            'icon'        => 'success'
        ]);
    }

    public function cancel()
    {
        $this->notification([
            'title'       => 'Has cancelado!',
            'description' => 'Ningún cambio realizado',
            'icon'        => 'info'
        ]);
        $this->authority = new Authority;
    }

    public function deleteQuestion($id)
    {
        $this->authority = Authority::findOrFail($id);

        if ($this->authority->status_delete) {
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
}
