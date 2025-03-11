<div class="mb-4 flex justify-between items-center">
    <div class="w-1/3">
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Buscar por nombre o cédula..." 
            class="w-full px-4 py-2 border rounded-md dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300">
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