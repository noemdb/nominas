<?php

namespace App\Http\Livewire\Institution\ExchangeRate;
//livewire.institution.exchange-rate.index-component


use App\Http\Livewire\Common\PaginateTrait;
use App\Http\Livewire\Common\WithSortingTrait;
use App\Models\Institution;
use App\Models\Institution\Currency;
use App\Models\Institution\ExchangeRate;
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

    public ExchangeRate $exchange_rate;
    public $list_comment;
    public $list_currency;
    public $list_account_type;
    public $showModal = false;
    public $modeCreate = false;
    public $modeEdit = false;
    public $modeShow = false;

    public function mount()
    {
        $this->exchange_rate = new ExchangeRate;
        $this->list_comment = ExchangeRate::COLUMN_COMMENTS;
        $this->list_currency = Currency::list_currency();
    }

    public function render()
    {
        $search = $this->search;
        $exchange_rates = ExchangeRate::select('exchange_rates.*','currencies.name as currency_name')
            ->join('currencies', 'currencies.id', '=', 'exchange_rates.currency_id');

        $exchange_rates = (!empty($search)) ? $exchange_rates->Where(
            function ($query) use ($search) {
                $query->orWhere('name', 'like', '%' . $search . '%');
                $query->orWhere('symbol', 'like', '%' . $search . '%');
            }
        )
            : $exchange_rates;

        $exchange_rates = ($this->sortBy && $this->sortDirection) ? $exchange_rates->orderBy($this->sortBy, $this->sortDirection) : $exchange_rates;

        $exchange_rates = $exchange_rates->paginate($this->paginate);
        return view('livewire.institution.exchange-rate.index-component', ['exchange_rates' => $exchange_rates]);
    }

    public function openModal(string $mode)
    {
        $this->showModal = true;
        $this->modeCreate = ($mode == 'create') ? true : false;
        $this->modeEdit = ($mode == 'edit') ? true : false;
        $this->modeShow = ($mode == 'show') ? true : false;

        $this->exchange_rate = ($this->modeCreate) ? new ExchangeRate : $this->exchange_rate ;
    }

    public function show($id)
    {
        $this->exchange_rate = ExchangeRate::findOrFail($id);
        $this->openModal('show');
    }

    public function save()
    {
        $this->validate();
        $this->exchange_rate->save();
        $this->exchange_rate = new ExchangeRate;
        $this->showModal = false;
        $this->notification()->success(
            $title = 'Felicitaciones!',
            $description = 'Registro guardado exitósamente.'
        );
    }

    public function edit($id)
    {
        $this->exchange_rate = ExchangeRate::findOrFail($id);
        $this->openModal('edit');
    }

    public function delete($id)
    {
        $exchange_rate = ExchangeRate::findOrFail($id);

        $exchange_rate->delete();
        $this->exchange_rate = new ExchangeRate;

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
        $this->exchange_rate = new ExchangeRate;
    }

    public function deleteQuestion($id)
    {
        $this->exchange_rate = ExchangeRate::findOrFail($id);

        if ($this->exchange_rate->status_delete) {
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
