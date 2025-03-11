<div>
    @if($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 max-w-md w-full">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                    Confirmar eliminación
                </h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    ¿Estás seguro de que deseas eliminar al trabajador <span class="font-semibold">{{ $workerName }}</span>? Esta acción no se puede deshacer.
                </p>
                <div class="flex justify-end space-x-3">
                    <button wire:click="cancel" 
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-md transition">
                        Cancelar
                    </button>
                    <button wire:click="delete" 
                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md transition">
                        Eliminar
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>

