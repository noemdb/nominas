<!-- Información Laboral -->
<div class="mb-8">
    <h2
        class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
        Información Laboral
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Fecha de Contratación -->
        <div>
            <label for="hire_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Fecha de Contratación
            </label>
            <input wire:model="worker.hire_date" type="date" id="hire_date"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
            @error('worker.hire_date')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Salario Base -->
        <div>
            <label for="base_salary" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Salario Base
            </label>
            <input wire:model="worker.base_salary" type="number" step="0.01" id="base_salary"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
            @error('worker.base_salary')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Tipo de Contrato -->
        <div>
            <label for="contract_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Tipo de Contrato
            </label>
            <select wire:model="worker.contract_type" id="contract_type"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                <option value="full-time">Tiempo Completo</option>
                <option value="part-time">Tiempo Parcial</option>
                <option value="temporary">Temporal</option>
                <option value="contract">Por Contrato</option>
            </select>
            @error('worker.contract_type')
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
    </div>
</div>
