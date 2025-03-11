<div class="max-w-7xl mx-auto p-6 lg:p-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
            Gestión de Trabajadores...
        </h1>
        <button wire:click="create"
            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition">
            Registrar Trabajador
        </button>
    </div>

    <!-- Filtros y búsqueda -->
    @include('livewire.data-management.searching.filter')

    <!-- Tabla de trabajadores -->
    <div class="bg-white dark:bg-gray-900 shadow-sm rounded-lg overflow-hidden">
        @include('livewire.data-management.partials.table')
    </div>

    <!-- Paginación -->
    <div class="mt-6">
        {{ $workers->links() }}
    </div>

    <!-- Modal para crear/editar trabajador -->
    @if($showModal)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 max-w-2xl w-full">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                {{ $isEdit ? 'Editar Trabajador' : 'Registrar Nuevo Trabajador' }}
            </h3>
            
            @include('livewire.data-management.partials.form')

        </div>
    </div>
    @endif

    <!-- Modal para crear/editar trabajador -->
    @if($showModal)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-2xl flex flex-col max-h-[90vh]">
            <!-- Encabezado del modal -->
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ $isEdit ? 'Editar Trabajador' : 'Registrar Nuevo Trabajador' }}
                    </h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Contenido del modal con scroll -->
            <div class="overflow-y-auto p-6 flex-grow">
                @include('livewire.data-management.partials.form')
            </div>
            
        </div>
    </div>
    @endif



    <!-- Modal de confirmación de eliminación -->
    @includeWhen($confirmingDelete, 'livewire.data-management.modal.confirmingDelete')
</div>

