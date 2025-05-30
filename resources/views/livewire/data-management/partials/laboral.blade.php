<!-- Información Laboral -->
<div class="mb-8">
    <h2
        class="mb-1 text-gray-800 border-b border-gray-200 text-end font-extralight text-md dark:text-gray-400 dark:border-gray-700">
        Información Laboral
    </h2>
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        <!-- Fecha de Contratación -->
        <div>
            <label for="hire_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Fecha de Contratación
            </label>
            <input wire:model.live="worker.hire_date" type="date" id="hire_date"
                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
            @error('worker.hire_date')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
            @if(isset($worker['hire_date']) && $worker['hire_date'])
                <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Antigüedad: {{ $this->workerSeniority['formatted'] }}
                </div>
            @endif
        </div>

        <!-- Salario Base -->
        <div>
            <label for="base_salary" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Salario Base
            </label>
            <input wire:model="worker.base_salary" type="number" step="0.01" id="base_salary"
                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
            @error('worker.base_salary')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Tipo de Contrato -->
        <div>
            <label for="contract_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Tipo de Contrato
            </label>
            <select wire:model="worker.contract_type" id="contract_type"
                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                <option selected>Seleccione</option>
                <option value="Tiempo Completo">Tiempo Completo</option>
                <option value="Tiempo Parcial">Tiempo Parcial</option>
                <option value="Temporal">Temporal</option>
                <option value="Por Contrato">Por Contrato</option>
            </select>
            @error('worker.contract_type')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Estado -->
        <div class="flex items-center mt-6">
            <x-wireui-checkbox label="Trabajador activo" id="size-md" wire:model="worker.is_active" value="md" md />
        </div>
    </div>
</div>
