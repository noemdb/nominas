<!-- Modal para crear/editar posiciones -->
<div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-400 bg-opacity-40"
wire:key="modal-{{ $isEdit ? 'edit-' . $workerId : 'create' }}">
<div
    class="flex flex-col w-full bg-white rounded-lg shadow-xl dark:bg-gray-800 max-w-fit">
    <!-- Encabezado del modal -->
    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ $isEdit ? 'Posiciones del Trabajador' : 'Registrar una Nueva Posición' }}
            </h3>
            <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Contenido del modal con scroll -->
    <div class="flex-grow p-4 overflow-y-auto">
        <livewire:data-management.positions-manager
            worker_id="{{ $isEdit ? $workerId : null }}" :key="$isEdit
                ? 'mode-positions-edit' . $workerId
                : 'mode-positions-create'" />
    </div>
</div>
</div>
