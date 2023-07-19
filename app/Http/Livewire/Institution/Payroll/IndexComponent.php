<?php

namespace App\Http\Livewire\Institution\Payroll;
//livewire.institution.payroll.index-component

use App\Http\Livewire\Common\PaginateTrait;
use App\Http\Livewire\Common\WithSortingTrait;
use App\Models\Institution;
use App\Models\Institution\Payroll;
use App\Models\Payroll\Level;
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

    public Payroll $payroll;
    public $list_comment;
    public $list_institution,$list_frequency,$list_level;
    public $showModal = false;
    public $modeCreate = false;
    public $modeEdit = false;
    public $modeShow = false;

    public function mount()
    {
        $this->payroll = new Payroll;
        $this->list_institution = Institution::list_institution();
        $this->list_level = Level::list_level();
        $this->list_frequency = Payroll::list_frequency();
        $this->list_comment = Payroll::COLUMN_COMMENTS;
    }

    public function render()
    {
        $search = $this->search;
        $payrolls = Payroll::select('payrolls.*','institutions.name as institution_name')
        ->join('institutions', 'institutions.id', '=', 'payrolls.institution_id');

        $payrolls = (!empty($search)) ? $payrolls->Where(
            function ($query) use ($search) {
                $query->orWhere('institutions.name', 'like', '%' . $search . '%');
                $query->orWhere('payrolls.name', 'like', '%' . $search . '%');
            }
        )
            : $payrolls;

        $payrolls = ($this->sortBy && $this->sortDirection) ? $payrolls->orderBy($this->sortBy, $this->sortDirection) : $payrolls;

        $payrolls = $payrolls->paginate($this->paginate);

        return view('livewire.institution.payroll.index-component', ['payrolls' => $payrolls]);
    }

    public function openModal(string $mode)
    {
        $this->showModal = true;
        $this->modeCreate = ($mode == 'create') ? true : false;
        $this->modeEdit = ($mode == 'edit') ? true : false;
        $this->modeShow = ($mode == 'show') ? true : false;
        //dd($this->modeCreate,$this->modeEdit,$this->modeShow);
    }

    public function show($id)
    {
        $this->payroll = Payroll::findOrFail($id);
        $this->openModal('show');
    }

    public function save()
    {
        $this->validate();
        $this->payroll->save();
        $this->payroll = new Payroll;
        $this->showModal = false;
        $this->notification()->success(
            $title = 'Felicitaciones!',
            $description = 'Registro guardado exitósamente.'
        );
    }

    public function edit($id)
    {
        $this->payroll = Payroll::findOrFail($id);
        $this->openModal('edit');
    }

    public function delete($id)
    {
        $payroll = Payroll::findOrFail($id);

        $payroll->delete();
        $this->payroll = new Payroll;

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
        $this->payroll = new Payroll;
    }

    public function deleteQuestion($id)
    {
        $this->payroll = Payroll::findOrFail($id);

        if ($this->payroll->status_delete) {
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
