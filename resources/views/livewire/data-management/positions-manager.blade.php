<div>
    

    <!-- Información sobre el Filtro -->
    @if ($selected_worker_id)
        <div class="p-1 mb-1">
            Mostrando cargos para el trabajador: {{ $selected_worker->fullname ?? null }}
        </div>
    @endif

    <!-- Botón para Crear Nuevo Cargo -->
    <button wire:click="createPosition" class="px-4 py-2 mb-4 text-white bg-blue-500 rounded hover:bg-blue-600">
        Crear Nuevo Cargo
    </button>

    @include('livewire.data-management.position.modal')

    @include('livewire.data-management.position.tab')

</div>
