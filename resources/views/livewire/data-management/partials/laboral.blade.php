<!-- Información Laboral -->
<div class="h-full mb-8">
    <h2
        class="mb-1 text-gray-800 border-b border-gray-200 text-end font-extralight text-md dark:text-gray-400 dark:border-gray-700">
        Información Laboral
    </h2>
    <div class="grid h-full grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        <!-- Fecha de Contratación -->
        <div class="flex flex-col">
            <x-wireui-datetime-picker
                wire:model.live="hire_date"
                label="Fecha de Contratación"
                placeholder="Seleccione"
                display-format="DD-MM-YYYY"
                class="flex-grow"
            />
            @if(isset($hire_date))
                <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Antigüedad: {{ $this->workerSeniority['formatted'] }}
                </div>
            @endif
        </div>

        <!-- Salario Base -->
        <div class="flex flex-col">
            <x-wireui-input
                label="Salario Base"
                placeholder="Ingrese el salario base"
                wire:model="base_salary"
                type="number"
                step="0.01"
                class="flex-grow"
            />
        </div>

        <!-- Tipo de Contrato -->
        <div class="flex flex-col">
            <x-wireui-select
                wire:model="contract_type"
                label="Tipo de Contrato"
                :options="[
                    ['label' => 'Tiempo Completo', 'value' => 'full-time', 'key' => 'full-time'],
                    ['label' => 'Tiempo Parcial', 'value' => 'part-time', 'key' => 'part-time'],
                    ['label' => 'Temporal', 'value' => 'temporary', 'key' => 'temporary'],
                    ['label' => 'Por Contrato', 'value' => 'contractor', 'key' => 'contractor']
                ]"
                option-label="label"
                option-value="value"
                option-key-value="key"
                class="flex-grow"
            />
        </div>

        <!-- Estado -->
        <div class="flex items-center mt-6">
            <x-wireui-checkbox
                label="Trabajador activo"
                wire:model="is_active"
            />
        </div>
    </div>
</div>
