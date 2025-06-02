<div class="mb-4">
    <!-- Contenedor Principal -->
    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <!-- Filtros -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end">
            <!-- Búsqueda -->
            <div class="flex-1">
                <x-wireui-input
                    icon="magnifying-glass"
                    wire:model.live.debounce.300ms="search"
                    label="Buscar trabajador"
                    placeholder="Nombre, cédula, área..."
                    hint="Ingresa el texto para filtrar el listado"
                    class="w-full"
                />
            </div>

            <!-- Filtro por Área -->
            <div class="sm:w-64">
                <x-wireui-select
                    wire:model.live="selectedArea"
                    label="Filtrar por área"
                    placeholder="Todas las áreas"
                    :options="$areaOptions"
                    option-label="label"
                    option-value="value"
                    class="w-full"
                />
            </div>

            <!-- Registros por página -->
            <div class="sm:w-48">
                <x-wireui-select
                    wire:model.live="perPage"
                    label="Mostrar"
                    :options="[
                        ['label' => '10 registros', 'value' => 10],
                        ['label' => '25 registros', 'value' => 25],
                        ['label' => '50 registros', 'value' => 50],
                        ['label' => '100 registros', 'value' => 100]
                    ]"
                    option-label="label"
                    option-value="value"
                    class="w-full"
                />
            </div>
        </div>

        <!-- Botones de Acción -->
        <div class="flex flex-wrap gap-2 mt-4 sm:flex-nowrap">
            @if($search)
                <x-wireui-button
                    flat
                    sm
                    icon="x-mark"
                    wire:click="clearSearch"
                    class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300"
                >
                    Limpiar búsqueda
                </x-wireui-button>
            @endif

            @if($selectedArea)
                <x-wireui-button
                    flat
                    sm
                    icon="x-mark"
                    wire:click="clearAreaFilter"
                    class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300"
                >
                    Limpiar filtro de área
                </x-wireui-button>
            @endif
        </div>
    </div>
</div>
