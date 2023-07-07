<?php

namespace App\Http\Livewire\Institution\Currency;
//livewire.institution.currency.index-component

use App\Http\Livewire\Common\PaginateTrait;
use App\Http\Livewire\Common\WithSortingTrait;
use App\Models\Institution;
use App\Models\Institution\Currency;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class IndexComponent extends Component
{

    use Rules;
    use Actions;
    use WithSortingTrait;
    use WithPagination;
    use PaginateTrait;

    public Currency $currency;
    public $list_comment;
    public $list_institution;
    public $list_account_type;
    public $showModal = false;
    public $modeCreate = false;
    public $modeEdit = false;
    public $modeShow = false;

    public function mount()
    {
        $this->currency = new Currency;
        $this->list_comment = Currency::COLUMN_COMMENTS;
        $this->list_institution = Institution::list_institution();
    }

    public function render()
    {
        $search = $this->search;
        $currencies = Currency::select('currencies.*');

        $currencies = (!empty($search)) ? $currencies->Where(
            function ($query) use ($search) {
                $query->orWhere('name', 'like', '%' . $search . '%');
                $query->orWhere('symbol', 'like', '%' . $search . '%');
            }
        )
            : $currencies;

        $currencies = ($this->sortBy && $this->sortDirection) ? $currencies->orderBy($this->sortBy, $this->sortDirection) : $currencies;

        $currencies = $currencies->paginate($this->paginate);
        return view('livewire.institution.currency.index-component', ['currencies' => $currencies]);
    }

    public function openModal(string $mode)
    {
        $this->showModal = true;
        $this->modeCreate = ($mode == 'create') ? true : false;
        $this->modeEdit = ($mode == 'edit') ? true : false;
        $this->modeShow = ($mode == 'show') ? true : false;

        $this->currency = ($this->modeCreate) ? new Currency : $this->currency ;
    }

    public function show($id)
    {
        $this->currency = Currency::findOrFail($id);
        $this->openModal('show');
    }

    public function save()
    {
        $this->validate();
        $this->currency->save();
        $this->currency = new Currency;
        $this->showModal = false;
        $this->notification()->success(
            $title = 'Felicitaciones!',
            $description = 'Registro guardado exitósamente.'
        );
    }

    public function edit($id)
    {
        $this->currency = Currency::findOrFail($id);
        $this->openModal('edit');
    }

    public function delete($id)
    {
        $currency = Currency::findOrFail($id);

        $currency->delete();
        $this->currency = new Currency;

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
        $this->currency = new Currency;
    }

    public function deleteQuestion($id)
    {
        $this->currency = Currency::findOrFail($id);

        if ($this->currency->status_delete) {
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
