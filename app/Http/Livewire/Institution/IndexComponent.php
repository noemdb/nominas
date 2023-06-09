<?php

namespace App\Http\Livewire\Institution;

use App\Models\Institution;
use Livewire\Component;

use WireUi\Traits\Actions;

class IndexComponent extends Component
{
    use Actions;

    public $showModal=false;
    public $list_comment;
    public $list_type;
    public $list_legal_status;

    public Institution $institution;

    protected $rules = [
        'institution.name' => 'required|string',
        'institution.type' => 'required|string',
        'institution.acronym' => 'nullable|string|max:5',
        'institution.address' => 'required|string|max:192',
        'institution.phone_number' => 'required|string',
        'institution.email' => 'required|email',
        'institution.website' => 'nullable|string',
        'institution.foundation_date' => 'nullable|date',
        'institution.legal_status' => 'required|string',
        'institution.tax_id' => 'required|string',
        'institution.registration_number' => 'required|string',
    ];

    protected function validationAttributes()
    {
        return [
            'institution.name' => $this->list_comment['name'],
            'institution.type' => $this->list_comment['type'],
            'institution.acronym' => $this->list_comment['acronym'],
            'institution.address' => $this->list_comment['address'],
            'institution.phone_number' => $this->list_comment['phone_number'],
            'institution.email' => $this->list_comment['email'],
            'institution.website' => $this->list_comment['website'],
            'institution.foundation_date' => $this->list_comment['foundation_date'],
            'institution.legal_status' => $this->list_comment['legal_status'],
            'institution.tax_id' => $this->list_comment['tax_id'],
            'institution.registration_number' => $this->list_comment['registration_number'],
        ];
    }

    public function save()
    {
        $data = $this->validate();

        $this->institution->save();

        $this->institution = New Institution;

        $this->closeModal();

        $this->notification()->success(
            $title = 'Felicitaciones!!!',
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
        $institutions = Institution::all();
        return view('livewire.institution.index-component',[
            'institutions' => $institutions
        ]);
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function deleteQuestion($id)
    {
        $this->institution = Institution::findOrFail($id);
        // use a simple syntax
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
