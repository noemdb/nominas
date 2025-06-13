<!-- Modal para crear/editar nómina -->
<x-modal
    :title="$editing ? 'Editar Nómina' : 'Crear Nómina'"
    :max-width="'2xl'"
    wire:key="modal-{{ $editing ? 'edit-' . $payrollId : 'create' }}">

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

                    />
                </div>

                <!-- Fecha Inicio -->
                <div>
                    <x-wireui-input
                        wire:model.live="date_start"
                        type="date"
                        label="Fecha de Inicio"
                        required
                    />
                </div>

                <!-- Fecha Fin -->
                <div>
                    <x-wireui-input
                        wire:model.live="date_end"
                        type="date"
                        label="Fecha de Fin"
                        required
                    />
                </div>

                <!-- Número de Días -->
                <div>
                    <x-wireui-input
                        wire:model="num_days"
                        type="number"
                        label="Número de Días"
                        placeholder="Ingrese el número de días"
                        min="1"
                        max="31"
                        required
                    />
                </div>

                <!-- Número de Semanas -->
                <div>
                    <x-wireui-input
                        wire:model="num_weeks"
                        type="number"
                        label="Número de Semanas del mes"
                        placeholder="Se calcula automáticamente"
                        min="1"
                        max="6"
                        required
                        readonly
                        disabled
                    />
                    <small class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        Se calcula automáticamente según el período seleccionado
                    </small>
                </div>

                <!-- Status Exchange -->
                <div class="sm:col-span-2">
                    <x-wireui-toggle
                        wire:model="status_exchange"
                        label="En moneda referencial [USD]"
                        description="Activar para indicar que la nómina será expresada en moneda de referencia [USD]"
                    />
                </div>

                <!-- Descripción -->
                <div class="sm:col-span-2">
                    <x-wireui-textarea
                        wire:model="description"
                        label="Descripción"
                        placeholder="Ingrese la descripción"
                    />
                </div>

                <!-- Observaciones -->
                <div class="sm:col-span-2">
                    <x-wireui-textarea
                        wire:model="observations"
                        label="Observaciones"
                        placeholder="Ingrese observaciones"
                    />
                </div>
            </div>
        </div>

        <!-- Sección de Estados -->
        <div class="space-y-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">Estados</h3>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <!-- Status Active -->
                <div>
                    <x-wireui-toggle
                        wire:model="status_active"
                        label="Activa"
                        description="Indica si la nómina está activa y en proceso"
                    />
                </div>

                <!-- Status Public -->
                <div>
                    <x-wireui-toggle
                        wire:model="status_public"
                        label="Pública"
                        description="Indica si la nómina es visible para los trabajadores"
                    />
                </div>

                <!-- Status Approved -->
                <div class="sm:col-span-2">
                    <x-wireui-toggle
                        wire:model="status_approved"
                        label="Aprobada"
                        description="Indica si la nómina ha sido aprobada por el responsable"
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
