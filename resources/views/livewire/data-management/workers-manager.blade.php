<div class="p-6 mx-auto lg:p-8">

    <!-- Estado de carga (Spinner) -->
    {{-- @include('components.loading') --}}

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
            Gestión de Trabajadores
        </h1>
        <x-wireui-button icon="plus" label="Registrar Trabajador" wire:click="create" />
    </div>

    <!-- Filtros y búsqueda -->
    @include('livewire.data-management.searching.filter')

    <!-- Tabla de trabajadores -->
    <div class="overflow-hidden bg-white rounded-lg shadow-sm dark:bg-gray-900">
        @include('livewire.data-management.partials.table')
    </div>

    <!-- Paginación -->
    <div class="mt-6">
        {{ $workers->links() }}
    </div>

    <!-- Modal para crear/editar trabajador -->
    @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50"
            wire:key="modal-{{ $isEdit ? 'edit-' . $worker['id'] : 'create' }}">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-2xl flex flex-col max-h-[90vh]">
                <!-- Encabezado del modal -->
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ $isEdit ? 'Editar Trabajador' : 'Registrar Nuevo Trabajador' }}
                        </h3>
                        <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Contenido del modal con scroll -->
                <div class="flex-grow p-4 overflow-y-auto">
                    @include('livewire.data-management.partials.form')
                </div>
            </div>
        </div>
    @endif

    <!-- Modal de confirmación de eliminación -->
    @includeWhen($confirmingDelete, 'livewire.data-management.modal.confirmingDelete')

    <div class="p-6 mx-auto max-w-7xl lg:p-8">
        <!-- Loading inicial del componente -->
        <div wire:init="setLoaded" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-75"
            x-data="{ show: true }" x-show="show" x-init="$wire.$on('component-loaded', () => { setTimeout(() => { show = false }, 300) })">
            <div class="flex flex-col items-center justify-center space-y-3 text-white">
                <svg class="w-12 h-12 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                <p class="text-lg font-semibold">Cargando componente...</p>
            </div>
        </div>

        <!-- Resto del contenido del componente -->
        <!-- ... -->
    </div>

</div>
