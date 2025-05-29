<div class="mb-4">
    <x-wireui-input wire:model.debounce.300ms="search" placeholder="Buscar deducciones..." class="w-full" />
    <div class="grid grid-cols-1 gap-4 mt-4 sm:grid-cols-3">
        <div>
            <x-wireui-select
                wire:model.live="filterPayrollId"
                label="Nómina"
                placeholder="Filtrar por nómina"
                :options="$payrollOptions"
                option-value="value"
                option-label="label"
                clearable
            />
        </div>
        <div>
            <x-wireui-select
                wire:model.live="filterStatusActive"
                label="Estado Activo"
                placeholder="Filtrar por estado"
                :options="[['value' => true, 'label' => 'Activo'], ['value' => false, 'label' => 'Inactivo']]"
                option-value="value"
                option-label="label"
                clearable
            />
        </div>
        <div>
            <x-wireui-select
                wire:model.live="filterStatusExchange"
                label="Moneda"
                placeholder="Filtrar por moneda"
                :options="[['value' => true, 'label' => 'USD'], ['value' => false, 'label' => 'Local (Bs.)']]"
                option-value="value"
                option-label="label"
                clearable
            />
        </div>
    </div>
</div>
