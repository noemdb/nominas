<div class="mb-4">
    <!-- Buscador Principal -->
    <x-wireui-input
        wire:model.debounce.300ms="search"
        placeholder="Buscar nóminas..."
        class="w-full"
        icon="magnifying-glass" />

    <!-- Filtros -->
    <div class="grid grid-cols-1 gap-4 mt-4 sm:grid-cols-4">
        <!-- Filtro de Fechas -->
        <div class="sm:col-span-2">
            <div class="grid grid-cols-2 gap-2">
                <x-wireui-input
                    wire:model.live="dateStartFilter"
                    type="date"
                    label="Desde"
                    placeholder="Fecha inicial"
                    class="w-full" />

                <x-wireui-input
                    wire:model.live="dateEndFilter"
                    type="date"
                    label="Hasta"
                    placeholder="Fecha final"
                    class="w-full" />
            </div>
        </div>

        <!-- Filtro de Moneda -->
        <div>
            <x-wireui-select
                wire:model.live="currencyFilter"
                label="Moneda"
                placeholder="Filtrar por moneda"
                :options="[
                    ['value' => '', 'label' => 'Todas las monedas'],
                    ['value' => '0', 'label' => 'Local (Bs.)'],
                    ['value' => '1', 'label' => 'Referencia (USD)']
                ]"
                option-value="value"
                option-label="label"
                clearable
                class="w-full" />
        </div>

        <!-- Botón Limpiar -->
        <div class="flex items-end">
            <x-wireui-button
                secondary
                icon="x-mark"
                label="Reiniciar"
                wire:click="clearFilters"
                class="w-full h-10" />
        </div>
    </div>
</div>
