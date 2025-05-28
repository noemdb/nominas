<!-- Modal para crear/editar comportamiento -->
<x-modal
    :title="$isEdit ? 'Editar Comportamiento' : 'Registrar Nuevo Comportamiento'"
    :max-width="'2xl'"
    wire:key="modal-{{ $isEdit ? 'edit-' . $behaviorId : 'create' }}">

    <form wire:submit.prevent="save" class="space-y-6">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <!-- Trabajador -->
            <div>
                <x-wireui-select
                    wire:model="behavior.worker_id"
                    label="Trabajador"
                    placeholder="Seleccione un trabajador"
                    :options="$workers->map(fn($worker) => ['label' => $worker->full_name, 'value' => $worker->id])"
                    option-value="value"
                    option-label="label"
                    required
                />
            </div>

            <!-- Fecha -->
            <div>
                <x-wireui-input
                    type="date"
                    wire:model="behavior.date"
                    label="Fecha"
                    required
                />
            </div>

            <!-- Asistencia -->
            <div>
                <x-wireui-input
                    type="number"
                    wire:model="behavior.attendance_days"
                    label="Días de Asistencia"
                    min="0"
                    required
                />
            </div>

            <!-- Faltas -->
            <div>
                <x-wireui-input
                    type="number"
                    wire:model="behavior.absences"
                    label="Faltas"
                    min="0"
                    required
                />
            </div>

            <!-- Permisos -->
            <div>
                <x-wireui-input
                    type="number"
                    wire:model="behavior.permissions"
                    label="Permisos"
                    min="0"
                    required
                />
            </div>

            <!-- Retardos -->
            <div>
                <x-wireui-input
                    type="number"
                    wire:model="behavior.delays"
                    label="Retardos"
                    min="0"
                    required
                />
            </div>

            <!-- Estado -->
            <div>
                <x-wireui-select
                    wire:model="behavior.status"
                    label="Estado"
                    :options="[
                        ['label' => 'Pendiente', 'value' => 'pending'],
                        ['label' => 'Aprobado', 'value' => 'approved'],
                        ['label' => 'Rechazado', 'value' => 'rejected']
                    ]"
                    option-value="value"
                    option-label="label"
                    required
                />
            </div>

            <!-- Observaciones -->
            <div class="sm:col-span-2">
                <x-wireui-textarea
                    wire:model="behavior.observations"
                    label="Observaciones"
                    placeholder="Ingrese observaciones adicionales..."
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
</x-modal>
