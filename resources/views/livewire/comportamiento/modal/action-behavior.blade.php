<!-- Modal para crear/editar comportamiento -->
<x-modal
    :title="$isEdit ? 'Editar Comportamiento' : 'Registrar Nuevo Comportamiento'"
    :max-width="'4xl'"
    wire:key="modal-{{ $isEdit ? 'edit-' . $behaviorId : 'create' }}">

    <form wire:submit.prevent="save" class="space-y-6">
        <!-- Información Básica -->
        <div class="p-4 bg-white border border-gray-200 rounded-lg dark:border-gray-700 dark:bg-gray-800/50">
            <h3 class="mb-3 text-sm font-semibold text-gray-700 dark:text-gray-300">Información General</h3>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <!-- Trabajador -->
                <div>
                    <x-wireui-select
                        wire:model="behavior.worker_id"
                        label="Trabajador"
                        placeholder="Seleccione un trabajador"
                        :options="$workerOptions"
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
            </div>
        </div>

        <!-- Navegación por Pestañas -->
        <div class="p-4 bg-white border border-gray-200 rounded-lg dark:border-gray-700 dark:bg-gray-800/50">
            <h3 class="mb-3 text-sm font-semibold text-gray-700 dark:text-gray-300">Detalles del Comportamiento</h3>
            <div class="mt-4" x-data="{ activeTab: $persist('asistencia') }">
                <!-- Pestañas -->
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <nav class="flex -mb-px space-x-6" aria-label="Tabs">
                        <!-- Pestaña Asistencia -->
                        <button
                            type="button"
                            @click="activeTab = 'asistencia'"
                            :class="{ 'border-primary-500 text-primary-600 dark:text-primary-400': activeTab === 'asistencia',
                                    'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300': activeTab !== 'asistencia' }"
                            class="flex items-center px-1 py-2 text-sm font-medium border-b-2 whitespace-nowrap">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Asistencia y Horas
                        </button>

                        <!-- Pestaña Permisos -->
                        <button
                            type="button"
                            @click="activeTab = 'permisos'"
                            :class="{ 'border-primary-500 text-primary-600 dark:text-primary-400': activeTab === 'permisos',
                                    'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300': activeTab !== 'permisos' }"
                            class="flex items-center px-1 py-2 text-sm font-medium border-b-2 whitespace-nowrap">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Permisos y Ausencias
                        </button>

                        <!-- Pestaña Financiera -->
                        <button
                            type="button"
                            @click="activeTab = 'financiera'"
                            :class="{ 'border-primary-500 text-primary-600 dark:text-primary-400': activeTab === 'financiera',
                                    'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300': activeTab !== 'financiera' }"
                            class="flex items-center px-1 py-2 text-sm font-medium border-b-2 whitespace-nowrap">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Información Financiera
                        </button>
                    </nav>
                </div>

                <!-- Contenido de las Pestañas -->
                <div class="mt-6">
                    <!-- Contenido Asistencia -->
                    <div x-show="activeTab === 'asistencia'" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95">
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                            <!-- Asistencia -->
                            <div class="space-y-4">
                                <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300">Asistencia</h4>
                                <x-wireui-input
                                    type="number"
                                    wire:model="behavior.attendance_days"
                                    label="Días de Asistencia"
                                    min="0"
                                    required
                                />
                                <x-wireui-input
                                    type="number"
                                    wire:model="behavior.absences"
                                    label="Faltas"
                                    min="0"
                                    required
                                />
                                <x-wireui-input
                                    type="number"
                                    wire:model="behavior.delays"
                                    label="Retardos"
                                    min="0"
                                    required
                                />
                            </div>

                            <!-- Horas -->
                            <div class="space-y-4">
                                <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300">Horas</h4>
                                <x-wireui-input
                                    type="number"
                                    wire:model="behavior.labor_hours"
                                    label="Horas Laboradas"
                                    min="0"
                                    step="0.01"
                                    required
                                />
                                <x-wireui-input
                                    type="number"
                                    wire:model="behavior.administrative_hours"
                                    label="Horas Administrativas"
                                    min="0"
                                    step="0.01"
                                    required
                                />
                            </div>

                            <!-- Estado -->
                            <div class="space-y-4">
                                <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300">Estado</h4>
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
                        </div>
                    </div>

                    <!-- Contenido Permisos -->
                    <div x-show="activeTab === 'permisos'" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95">
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <!-- Permisos -->
                            <div class="space-y-4">
                                <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300">Permisos</h4>
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                    <div>
                                        <x-wireui-input
                                            type="number"
                                            wire:model="behavior.paid_permission_days"
                                            label="Días de Permiso Pagado"
                                            min="0"
                                            required
                                        />
                                    </div>
                                    <div>
                                        <x-wireui-input
                                            type="number"
                                            wire:model="behavior.paid_permission_hours"
                                            label="Horas de Permiso Pagado"
                                            min="0"
                                            step="0.01"
                                            required
                                        />
                                    </div>
                                    <div>
                                        <x-wireui-input
                                            type="number"
                                            wire:model="behavior.unpaid_permission_days"
                                            label="Días de Permiso No Pagado"
                                            min="0"
                                            required
                                        />
                                    </div>
                                    <div>
                                        <x-wireui-input
                                            type="number"
                                            wire:model="behavior.unpaid_permission_hours"
                                            label="Horas de Permiso No Pagado"
                                            min="0"
                                            step="0.01"
                                            required
                                        />
                                    </div>
                                </div>
                            </div>

                            <!-- Ausencias y Reposo -->
                            <div class="space-y-4">
                                <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300">Ausencias y Reposo</h4>
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                    <div>
                                        <x-wireui-input
                                            type="number"
                                            wire:model="behavior.medical_rest_days"
                                            label="Días de Reposo Médico"
                                            min="0"
                                            required
                                        />
                                    </div>
                                    <div>
                                        <x-wireui-input
                                            type="number"
                                            wire:model="behavior.medical_rest_hours"
                                            label="Horas de Reposo Médico"
                                            min="0"
                                            step="0.01"
                                            required
                                        />
                                    </div>
                                    <div>
                                        <x-wireui-input
                                            type="number"
                                            wire:model="behavior.unjustified_absence_days"
                                            label="Días de Faltas Injustificadas"
                                            min="0"
                                            required
                                        />
                                    </div>
                                    <div>
                                        <x-wireui-input
                                            type="number"
                                            wire:model="behavior.unjustified_absence_hours"
                                            label="Horas de Faltas Injustificadas"
                                            min="0"
                                            step="0.01"
                                            required
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contenido Financiero -->
                    <div x-show="activeTab === 'financiera'" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95">
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <!-- Bonificaciones -->
                            <div class="space-y-4">
                                <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300">Bonificaciones</h4>
                                <x-wireui-input
                                    type="number"
                                    wire:model="behavior.bonus"
                                    label="Bonificación"
                                    min="0"
                                    step="0.01"
                                    required
                                />
                            </div>

                            <!-- Descuentos -->
                            <div class="space-y-4">
                                <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300">Descuentos</h4>
                                <x-wireui-input
                                    type="number"
                                    wire:model="behavior.discount"
                                    label="Descuento"
                                    min="0"
                                    step="0.01"
                                    required
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Observaciones -->
        <div class="p-4 bg-white border border-gray-200 rounded-lg dark:border-gray-700 dark:bg-gray-800/50">
            {{-- <h3 class="mb-3 text-sm font-semibold text-gray-700 dark:text-gray-300">Observaciones</h3> --}}
            <x-wireui-textarea
                wire:model="behavior.observations"
                label="Observaciones"
                placeholder="Ingrese observaciones adicionales..."
                rows="8"
                readonly
            />
        </div>

        <x-wireui-errors />

        <!-- Botones -->
        <div class="flex justify-end pt-2 space-x-2 border-t border-gray-200 dark:border-gray-700">
            <x-wireui-button white label="Cancelar" wire:click="closeModal" onclick="event.preventDefault();"/>
            <x-wireui-button type="submit" :label="$isEdit ? 'Actualizar' : 'Registrar'" />
        </div>
    </form>
</x-modal>
