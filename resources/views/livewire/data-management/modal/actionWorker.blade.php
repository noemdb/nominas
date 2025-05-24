<!-- Modal para crear/editar trabajador -->
<x-modal
    :title="$isEdit ? 'Editar Trabajador' : 'Registrar Nuevo Trabajador'"
    :max-width="'2xl'"
    wire:key="modal-{{ $isEdit ? 'edit-' . $worker['id'] : 'create' }}">
    @include('livewire.data-management.partials.form')
</x-modal>
