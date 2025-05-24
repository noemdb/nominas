<div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="w-full max-w-md p-6 bg-white rounded-lg dark:bg-gray-800">
        <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-gray-100">
            Confirmar eliminación
        </h3>
        <p class="mb-6 text-gray-600 dark:text-gray-400">
            ¿Estás seguro de que deseas eliminar este registro de comportamiento? Esta acción no se puede deshacer.
        </p>
        <div class="flex justify-end space-x-3">
            <button wire:click="closeModal"
                class="px-4 py-2 text-gray-800 transition bg-gray-200 rounded-md hover:bg-gray-300">
                Cancelar
            </button>
            <button wire:click="deleteBehavior"
                class="px-4 py-2 text-white transition bg-red-600 rounded-md hover:bg-red-700">
                Eliminar
            </button>
        </div>
    </div>
</div>
