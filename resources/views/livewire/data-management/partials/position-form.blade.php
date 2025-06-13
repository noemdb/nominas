<form wire:submit="save">
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <!-- Área -->
        <div>
            <x-wireui-select
                wire:model="area_id"
                label="Área"
                :options="\App\Models\Area::getSelectOptions()"
                option-label="label"
                option-value="value"
                option-key-value="key"
            />
        </div>

        <!-- Rol -->
        <div>
            <x-wireui-select
                wire:model="rol_id"
                label="Rol"
                :options="\App\Models\Rol::getSelectOptions()"
                option-label="label"
                option-value="value"
                option-key-value="key"
            />
        </div>

        <!-- Fecha de Inicio -->
        <div>
            <x-wireui-datetime-picker
                wire:model="start_date"
                label="Fecha de Inicio"
                placeholder="Seleccione"
                display-format="DD-MM-YYYY"
            />
        </div>

        <!-- Fecha de Fin -->
        <div>
            <x-wireui-datetime-picker
                wire:model="end_date"
                label="Fecha de Fin"
                placeholder="Seleccione (opcional)"
                display-format="DD-MM-YYYY"
            />
        </div>

        <!-- Salario Base -->
        <div>
            <x-wireui-input
                wire:model="base_salary_pos"
                label="Salario Base"
                type="number"
                step="0.01"
                placeholder="Ingrese el salario base"
            />
        </div>

        <!-- Estado -->
        <div class="flex items-center mt-6">
            <x-wireui-checkbox
                wire:model="is_active"
                label="Posición activa"
            />
        </div>
    </div>

    <x-wireui-errors />

    <!-- Botones -->
    <div class="flex justify-end mt-8 space-x-3">
        <x-wireui-button white label="Cancelar" wire:click="closeModal" onclick="event.preventDefault();"/>
        <x-wireui-button type="submit" :label="$isEdit ? 'Actualizar' : 'Registrar'" />
    </div>
</form>