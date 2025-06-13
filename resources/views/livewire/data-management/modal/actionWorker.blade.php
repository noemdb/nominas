<!-- Modal para crear/editar trabajador -->
<x-modal
    :title="$isEdit ? 'Editar Trabajador' : 'Registrar Nuevo Trabajador'"
    :max-width="'2xl'"
    fullHeight="true"
    wire:key="modal-{{ $isEdit ? 'edit-' . $workerId : 'create' }}">
    @include('livewire.data-management.partials.form')
</x-modal>
