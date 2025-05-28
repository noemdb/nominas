<!-- Modal para crear/editar descuento -->
<x-modal
    :title="$editing ? 'Editar Descuento' : 'Crear Descuento'"
    :max-width="'2xl'"
    wire:key="modal-{{ $editing ? 'edit-' . $editing : 'create' }}">

    <form wire:submit.prevent="save" class="space-y-6">
        <!-- Sección de Información Básica -->
        <div class="space-y-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">Información Básica</h3>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <!-- Nombre -->
                <div class="sm:col-span-2">
                    <x-wireui-input
                        wire:model="name"
                        label="Nombre"
                        placeholder="Ingrese el nombre"
                        required
                    />
                </div>

                <!-- Tipo -->
                <div>
                    <x-wireui-select wire:model.live="type"
                            label="Tipo"
                            placeholder="Seleccione el tipo"
                            :options="$discountTypeOptions"
                            option-value="value"
                            option-label="label"
                            option-description="description"
                            required
                        />
                </div>

                <!-- Monto/Variable -->
                <div class="sm:col-span-2">
                    @if($type === 'fijo')
                        <x-wireui-input
                            wire:model="amount"
                            type="number"
                            step="0.01"
                            label="Monto"
                            placeholder="Ingrese el monto"
                            required
                        />
                    @endif
                    @if($type === 'variable')
                        <div class="flex gap-2">
                            <x-wireui-select
                                wire:model="name_function"
                                label="Función de cálculo"
                                placeholder="Seleccione la función"
                                :options="$discountfunctionOptions"
                                option-value="value"
                                option-label="label"
                                option-description="description"
                                required
                            />
                        </div>
                    @endif
                </div>

                <!-- Descripción -->
                <div class="sm:col-span-2">
                    <x-wireui-textarea
                        wire:model="description"
                        label="Descripción"
                        placeholder="Ingrese la descripción"
                    />
                </div>
            </div>
        </div>

        <!-- Sección de Aplicabilidad -->
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">Aplicabilidad</h3>
                <span class="text-sm text-gray-500 dark:text-gray-400">Seleccione solo un criterio de aplicación</span>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <!-- Institución -->
                <div>
                    <x-wireui-select
                        wire:model="institution_id"
                        label="Institución"
                        placeholder="Seleccione una institución"
                        :options="$institutionOptions"
                        option-value="value"
                        option-label="label"
                    />
                </div>

                <!-- Área -->
                <div>
                    <x-wireui-select
                        wire:model="area_id"
                        label="Área"
                        placeholder="Seleccione un área"
                        :options="$areaOptions"
                        option-value="value"
                        option-label="label"
                    />
                </div>

                <!-- Rol -->
                <div>
                    <x-wireui-select
                        wire:model="rol_id"
                        label="Rol"
                        placeholder="Seleccione un rol"
                        :options="$rolOptions"
                        option-value="value"
                        option-label="label"
                    />
                </div>

                <!-- Trabajador -->
                <div>
                    <x-wireui-select
                        wire:model="worker_id"
                        label="Trabajador"
                        placeholder="Seleccione un trabajador"
                        :options="$workerOptions"
                        option-value="value"
                        option-label="label"
                    />
                </div>
            </div>
        </div>

        <x-wireui-errors />

        <!-- Botones -->
        <div class="flex justify-end mt-8 space-x-3">
            <x-wireui-button white label="Cancelar" wire:click="closeModal" onclick="event.preventDefault();"/>
            <x-wireui-button type="submit" :label="$editing ? 'Actualizar' : 'Guardar'" />
        </div>
    </form>
</x-modal>
