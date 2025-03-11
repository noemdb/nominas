<div class="mb-4 flex justify-between items-center">
    <div class="w-1/3">

        <div class="relative w-full">
            <x-input
                icon="user"
                wire:model.live.debounce.300ms="search"
                label="Filtrar"
                placeholder="Buscar por nombre, cédula, área..."
                description="Ingresa el texto para filtrar el listado"
            />
        
            <!-- Botón para limpiar el input -->
            @if ($search)
                <button 
                    type="button" 
                    wire:click="clearSearch"
                    class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 dark:hover:text-gray-400"
                >
                    &times;
                </button>
            @endif
        </div>
        
    </div>
    <div class="flex items-center space-x-2">
        <select wire:model.live="perPage" class="px-4 py-2 border rounded-md dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300">
            <option value="10">10 por página</option>
            <option value="25">25 por página</option>
            <option value="50">50 por página</option>
            <option value="100">100 por página</option>
        </select>
    </div>
</div>