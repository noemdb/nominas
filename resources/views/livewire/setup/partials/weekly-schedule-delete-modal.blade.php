<div class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75">
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-xl">
        <h3 class="mb-4 text-lg font-medium text-gray-900">Confirmar Eliminación</h3>
        <p class="mb-4 text-gray-500">¿Está seguro que desea eliminar este horario? Esta acción no se puede deshacer.</p>
        <div class="flex justify-end space-x-4">
            <button wire:click="$set('showDeleteModal', false)" class="px-4 py-2 text-gray-700 bg-gray-300 rounded-lg hover:bg-gray-400">
                Cancelar
            </button>
            <button wire:click="delete" class="px-4 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700">
                Eliminar
            </button>
        </div>
    </div>
</div>
