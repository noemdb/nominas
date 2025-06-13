<x-modal
    :title="$showModalPosition ? 'Editar Posición' : 'Registrar Nuevo Posición'"
    :max-width="'2xl'"
    fullHeight="true"
    wire:key="modal-{{ $showModalPosition ? 'edit-' . $workerId : 'create' }}">

    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ $showModalPosition ? 'Posiciones del Trabajador' : 'Registrar una Nueva Posición' }}
            </h3>
        </div>
    </div>

    <div class="flex-grow p-4 overflow-y-auto">
        {{ $workerId ?? 'no hay trabajador'}}
        <livewire:data-management.positions-manager
            worker_id="{{ $workerId ?? null }}" :key="$isEdit
                ? 'mode-positions-edit' . $workerId
                : 'mode-positions-create'" />
    </div>
</x-modal>
