<div class="p-6 mx-auto max-w-7xl lg:p-8">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
            {{ $isEdit ? 'Editar Trabajador' : 'Registrar Nuevo Trabajador' }}
        </h1>
    </div>

    <div class="p-6 bg-white rounded-lg shadow-sm dark:bg-gray-900">
        <form wire:submit="save">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <!-- Nombre completo -->
                <div>
                    <label for="fullname" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Nombre completo
                    </label>
                    <input wire:model="worker.fullname" type="text" id="fullname"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                    @error('worker.fullname')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Cédula -->
                <div>
                    <label for="identification" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Cédula
                    </label>
                    <input wire:model="worker.identification" type="text" id="identification"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                    @error('worker.identification')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Cargo -->
                <div>
                    <label for="current_position_info" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Cargo
                    </label>
                    <input wire:model="worker.current_position_info" type="text" id="current_position_info"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                    @error('worker.current_position_info')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Salario base -->
                <div>
                    <label for="base_salary" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Salario base
                    </label>
                    <input wire:model="worker.base_salary" type="number" step="0.01" id="base_salary"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                    @error('worker.base_salary')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Antigüedad (solo lectura) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Antigüedad
                    </label>
                    <div class="block w-full px-3 py-2 mt-1 bg-gray-100 border border-gray-300 rounded-md dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                        {{ $worker->formatted_seniority }}
                    </div>
                </div>

                <!-- Estado -->
                <div class="flex items-center mt-6">
                    <input wire:model="worker.is_active" type="checkbox" id="is_active"
                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <label for="is_active" class="block ml-2 text-sm text-gray-700 dark:text-gray-300">
                        Trabajador activo
                    </label>
                </div>

                <!-- Estado de posición -->
                <div class="flex items-center mt-6">
                    <input wire:model="worker.status_positions" type="checkbox" id="status_positions"
                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <label for="status_positions" class="block ml-2 text-sm text-gray-700 dark:text-gray-300">
                        Posición activa
                    </label>
                </div>
            </div>

            <div class="flex justify-end mt-8 space-x-3">
                <a href="{{ route('workers.index') }}"
                    class="px-4 py-2 text-gray-800 transition bg-gray-200 rounded-md hover:bg-gray-300">
                    Cancelar
                </a>
                <button type="submit"
                    class="px-4 py-2 text-white transition bg-blue-600 rounded-md hover:bg-blue-700">
                    {{ $isEdit ? 'Actualizar' : 'Registrar' }}
                </button>
            </div>
        </form>
    </div>
</div>

