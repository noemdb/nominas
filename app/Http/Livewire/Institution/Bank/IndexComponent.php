<?php

namespace App\Http\Livewire\Institution\Bank;

use App\Http\Livewire\Common\PaginateTrait;
use App\Http\Livewire\Common\WithSortingTrait;
use App\Models\Institution\Bank;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class IndexComponent extends Component
{

    // use BankRules;
    use Actions;
    use WithSortingTrait;
    use WithPagination;
    use PaginateTrait;

    public Bank $bank;
    public $list_comment;
    public $list_institution;
    public $list_account_type;
    public $showModal = false;
    public $modeCreate = false;
    public $modeEdit = false;
    public $modeShow = false;

    public function mount()
    {
        $this->bank = new Bank;
        $this->list_institution = Bank::list_institution();
        $this->list_comment = Bank::COLUMN_COMMENTS;
        $this->list_account_type = Bank::list_account_type();
    }

    public function render()
    {
        $search = $this->search;
        $banks = Bank::select('banks.*');

        $banks = (!empty($search)) ? $banks->Where(
            function ($query) use ($search) {
                $query->orWhere('name', 'like', '%' . $search . '%');
                $query->orWhere('description', 'like', '%' . $search . '%');
            }
        )
            : $banks;

        $banks = ($this->sortBy && $this->sortDirection) ? $banks->orderBy($this->sortBy, $this->sortDirection) : $banks;

        $banks = $banks->paginate($this->paginate);
        return view('livewire.institution.bank.index-component', ['banks' => $banks]);
    }

    public function openModal(string $mode)
    {
        $this->showModal = true;
        $this->modeCreate = ($mode == 'create') ? true : false;
        $this->modeEdit = ($mode == 'edit') ? true : false;
        $this->modeShow = ($mode == 'show') ? true : false;
    }

    public function show($id)
    {
        $this->bank = Bank::findOrFail($id);
        $this->openModal('show');
    }

    public function save()
    {
        $this->validate();
        $this->bank->save();
        $this->bank = new Bank;
        $this->showModal = false;
        $this->notification()->success(
            $title = 'Felicitaciones!',
            $description = 'Registro guardado exitósamente.'
        );
    }

    public function edit($id)
    {
        $this->bank = Bank::findOrFail($id);
        $this->openModal('edit');
    }

    public function delete($id)
    {
        $bank = Bank::findOrFail($id);

        $bank->delete();
        $this->bank = new Bank;

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
        $this->bank = new Bank;
    }

    public function deleteQuestion($id)
    {
        $this->bank = Bank::findOrFail($id);

        if ($this->bank->status_delete) {
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
