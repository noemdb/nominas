<div>
    <div class="flex flex-col items-center justify-between mb-6 space-y-4 sm:flex-row sm:space-y-0">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
            Gestión de Trabajadores
        </h1>
        <x-wireui-button icon="plus" label="Registrar Trabajador" wire:click="create" />
    </div>

    <!-- Filtros y búsqueda -->
    @include('livewire.data-management.searching.filter')

    <!-- Tabla de trabajadores -->
    <div class="overflow-hidden bg-white rounded-lg shadow-sm dark:bg-gray-900">
        @if (!$isLoaded)
            <x-skeleton.table :rows="5" />
        @else
            @include('livewire.data-management.partials.table')
        @endif
    </div>

    <!-- Paginación -->
    <div class="mt-6">
        {{ $workers->links() }}
    </div>

    <!-- Modal para crear/editar trabajador -->
    @if ($showDetailsModal)
        @include('livewire.data-management.modal.worker-details')
    @endif

    @if($showModal)
        @include('livewire.data-management.modal.actionWorker')
    @endif

    @if($showModalPosition)
        @include('livewire.data-management.modal.actionPositions')
    @endif

    <!-- Modal de confirmación de eliminación -->
    @includeWhen($confirmingDelete, 'livewire.data-management.modal.confirmingDelete')

    <livewire:loading-indicator />

</div>
