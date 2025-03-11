<div class="max-w-7xl mx-auto p-6 lg:p-8">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
            {{ $isEdit ? 'Editar Trabajador' : 'Registrar Nuevo Trabajador' }}
        </h1>
    </div>

    <div class="bg-white dark:bg-gray-900 shadow-sm rounded-lg p-6">
        <form wire:submit="save">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nombre completo -->
                <div>
                    <label for="fullname" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Nombre completo
                    </label>
                    <input wire:model="worker.fullname" type="text" id="fullname" 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                    @error('worker.fullname') 
                        <span class="text-red-500 text-sm">{{ $message }}</span> 
                    @enderror
                </div>

                <!-- Cédula -->
                <div>
                    <label for="identification" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Cédula
                    </label>
                    <input wire:model="worker.identification" type="text" id="identification" 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                    @error('worker.identification') 
                        <span class="text-red-500 text-sm">{{ $message }}</span> 
                    @enderror
                </div>

                <!-- Cargo -->
                <div>
                    <label for="current_position_info" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Cargo
                    </label>
                    <input wire:model="worker.current_position_info" type="text" id="current_position_info" 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                    @error('worker.current_position_info') 
                        <span class="text-red-500 text-sm">{{ $message }}</span> 
                    @enderror
                </div>

                <!-- Salario base -->
                <div>
                    <label for="base_salary" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Salario base
                    </label>
                    <input wire:model="worker.base_salary" type="number" step="0.01" id="base_salary" 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                    @error('worker.base_salary') 
                        <span class="text-red-500 text-sm">{{ $message }}</span> 
                    @enderror
                </div>

                <!-- Estado -->
                <div class="flex items-center mt-6">
                    <input wire:model="worker.is_active" type="checkbox" id="is_active" 
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="is_active" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                        Trabajador activo
                    </label>
                </div>

                <!-- Estado de posición -->
                <div class="flex items-center mt-6">
                    <input wire:model="worker.status_positions" type="checkbox" id="status_positions" 
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="status_positions" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                        Posición activa
                    </label>
                </div>
            </div>

            <div class="mt-8 flex justify-end space-x-3">
                <a href="{{ route('workers.index') }}" 
                    class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-md transition">
                    Cancelar
                </a>
                <button type="submit" 
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition">
                    {{ $isEdit ? 'Actualizar' : 'Registrar' }}
                </button>
            </div>
        </form>
    </div>
</div>

