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
                        required
                    />
                </div>

                <!-- Fecha Inicio -->
                <div>
                    <x-wireui-input
                        wire:model="date_start"
                        type="date"
                        label="Fecha de Inicio"
                        required
                    />
                </div>

                <!-- Fecha Fin -->
                <div>
                    <x-wireui-input
                        wire:model="date_end"
                        type="date"
                        label="Fecha de Fin"
                        required
                    />
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
