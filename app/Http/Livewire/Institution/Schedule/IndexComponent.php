<?php

namespace App\Http\Livewire\Institution\Schedule;

use App\Http\Livewire\Common\PaginateTrait;
use App\Http\Livewire\Common\WithSortingTrait;
use App\Models\Institution\Schedule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class IndexComponent extends Component
{
    // use ScheduleRules;
    use Actions;
    use WithSortingTrait;
    use WithPagination;
    use PaginateTrait;

    public Schedule $schedule;
    public $list_comment;
    public $list_areas;
    public $list_type;
    public $list_rols;
    public $showModal = false;
    public $modeCreate = false;
    public $modeEdit = false;
    public $modeShow = false;

    public function mount()
    {
        $this->schedule = new Schedule;
        $this->list_comment = Schedule::COLUMN_COMMENTS;
        $this->list_areas = Schedule::list_area();
        $this->list_type = Schedule::list_type();
        $this->list_rols = Schedule::list_rols();
    }
    public function render()
    {
        $search = $this->search;
        $schedules = Schedule::select('schedules.*');

        $schedules = (!empty($search)) ? $schedules->Where(
            function ($query) use ($search) {
                $query->orWhere('start_time', 'like', '%' . $search . '%');
                $query->orWhere('end_time', 'like', '%' . $search . '%');
                $query->orWhere('schedule_type', 'like', '%' . $search . '%');
                $query->orWhere('weekday', 'like', '%' . $search . '%');
            }
        )
            : $schedules;

        $schedules = ($this->sortBy && $this->sortDirection) ? $schedules->orderBy($this->sortBy, $this->sortDirection) : $schedules;

        $schedules = $schedules->paginate($this->paginate);
        return view('livewire.institution.schedule.index-component', ['schedules' => $schedules]);
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
        $this->schedule = Schedule::findOrFail($id);
        $this->openModal('show');
    }

    public function save()
    {
        $this->validate();
        $this->schedule->save();
        $this->schedule = new Schedule;
        $this->showModal = false;
        $this->notification()->success(
            $title = 'Felicitaciones!',
            $description = 'Registro guardado exitósamente.'
        );
    }

    public function edit($id)
    {
        $this->schedule = Schedule::findOrFail($id);
        $this->openModal('edit');
    }

    public function delete($id)
    {
        $schedule = Schedule::findOrFail($id);

        $schedule->delete();
        $this->schedule = new Schedule;

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
        $this->schedule = new Schedule;
    }

    public function deleteQuestion($id)
    {
        $this->schedule = Schedule::findOrFail($id);

        if ($this->schedule->status_delete) {
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
