<!-- Modal para crear/editar horario semanal -->
<x-modal
    :title="$editingScheduleId ? 'Editar Horario' : 'Nuevo Horario'"
    :max-width="'2xl'"
    wire:key="modal-{{ $editingScheduleId ? 'edit-' . $editingScheduleId : 'create' }}">

    <form wire:submit.prevent="save" class="space-y-8">
        <!-- Sección de Información Básica -->
        <div class="p-6 space-y-6 bg-white rounded-lg shadow-sm dark:bg-gray-800/50">
            <div class="flex items-center pb-4 space-x-2 border-b border-gray-200 dark:border-gray-700">
                <x-wireui-icon name="document-text" class="w-5 h-5 text-blue-500 dark:text-blue-400" />
                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">Información Básica</h3>
            </div>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <!-- Cargo -->
                <div class="sm:col-span-2">
                    <x-wireui-select
                        wire:model.live="position_id"
                        label="Cargo"
                        placeholder="Seleccione un cargo"
                        :options="$positionOptions"
                        option-value="value"
                        option-label="label"
                        option-description="description"
                        required
                    />
                </div>

                <!-- Día de la Semana -->
                <div>
                    <x-wireui-select
                        wire:model="day_of_week"
                        label="Día de la Semana"
                        placeholder="Seleccione un día"
                        :options="collect($daysOfWeek)->map(function($label, $value) {
                            return [
                                'value' => $value,
                                'label' => $label,
                                'description' => 'Día de la semana para el horario'
                            ];
                        })->values()"
                        option-value="value"
                        option-label="label"
                        option-description="description"
                        required
                    />
                </div>

                <!-- Horas Planificadas -->
                <div>
                    <x-wireui-input
                        wire:model="planned_hours"
                        type="number"
                        step="0.5"
                        min="0"
                        max="24"
                        label="Horas Planificadas"
                        placeholder="Ingrese las horas"
                        required
                    />
                </div>

                <!-- Estado -->
                <div class="sm:col-span-2">
                    <x-wireui-toggle
                        wire:model="is_active"
                        label="Activo"
                        description="Activar para que el horario esté disponible para su uso."
                    />
                </div>

                <!-- Observaciones -->
                <div class="sm:col-span-2">
                    <x-wireui-textarea
                        wire:model="observations"
                        label="Observaciones"
                        placeholder="Ingrese observaciones adicionales"
                        rows="2"
                    />
                </div>
            </div>
        </div>

        <!-- Sección de Resumen de Horas -->
        @if($position_id)
            <div class="p-6 space-y-6 rounded-lg shadow-sm bg-gray-50 dark:bg-gray-800/30">
                <div class="flex items-center justify-between pb-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center space-x-2">
                        <x-wireui-icon name="clock" class="w-5 h-5 text-blue-500 dark:text-blue-400" />
                        <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">Resumen de Horas</h3>
                    </div>
                    <div class="flex items-center space-x-2">
                        <x-wireui-icon name="calendar" class="w-5 h-5 text-gray-400" />
                        <span class="text-sm text-gray-500 dark:text-gray-400">Horario Semanal</span>
                    </div>
                </div>

                <!-- Resumen de Totales -->

                <!-- Información del Trabajador -->
                @if($workerInfo && $positionInfo)
                    <div class="p-4 bg-white rounded-lg shadow-sm dark:bg-gray-700/50">
                        <div class="space-y-4">
                            <!-- Información del Trabajador -->
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 overflow-hidden bg-gray-200 rounded-full dark:bg-gray-600">
                                        <x-wireui-icon name="user" class="w-full h-full p-2 text-gray-400" />
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        {{ $workerInfo->first_name }} {{ $workerInfo->last_name }}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        {{ $workerInfo->identification }}
                                    </p>
                                </div>
                                <div class="flex-shrink-0">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $workerInfo->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                        {{ $workerInfo->is_active ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Información del Cargo -->
                            <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                    <!-- Área -->
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0">
                                            <x-wireui-icon name="building-office" class="w-5 h-5 text-gray-400" />
                                        </div>
                                        <div>
                                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Área</p>
                                            <p class="text-sm text-gray-900 dark:text-white">{{ $positionInfo->area->name }}</p>
                                        </div>
                                    </div>

                                    <!-- Rol -->
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0">
                                            <x-wireui-icon name="cog-6-tooth" class="w-5 h-5 text-gray-400" />
                                        </div>
                                        <div>
                                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Rol</p>
                                            <p class="text-sm text-gray-900 dark:text-white">{{ $positionInfo->rol->name }}</p>
                                        </div>
                                    </div>

                                    <!-- Salario Base -->
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0">
                                            <x-wireui-icon name="currency-dollar" class="w-5 h-5 text-gray-400" />
                                        </div>
                                        <div>
                                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Salario Base</p>
                                            <p class="text-sm text-gray-900 dark:text-white">Bs. {{ number_format($positionInfo->base_salary, 2) }}</p>
                                        </div>
                                    </div>

                                    <!-- Estado del Cargo -->
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0">
                                            <x-wireui-icon name="adjustments-vertical" class="w-5 h-5 text-gray-400" />
                                        </div>
                                        <div>
                                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Estado del Cargo</p>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $positionInfo->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                                {{ $positionInfo->is_active ? 'Activo' : 'Inactivo' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                @if($positionInfo->observations)
                                    <div class="pt-4 mt-4 border-t border-gray-200 dark:border-gray-700">
                                        <div class="flex items-start space-x-3">
                                            <div class="flex-shrink-0">
                                                <x-wireui-icon name="document-text" class="w-5 h-5 text-gray-400" />
                                            </div>
                                            <div>
                                                <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Observaciones</p>
                                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $positionInfo->observations }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <div class="p-4 bg-yellow-50 rounded-lg shadow-sm dark:bg-yellow-900/20">
                        <div class="flex items-start space-x-3">
                            <x-wireui-icon name="exclamation-triangle" class="w-5 h-5 text-yellow-500 dark:text-yellow-400 mt-0.5" />
                            <div>
                                <p class="text-sm font-medium text-yellow-800 dark:text-yellow-200">Información no disponible</p>
                                <p class="mt-1 text-xs text-yellow-700 dark:text-yellow-300">Los datos del trabajador o del cargo no están disponibles actualmente.</p>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div class="p-4 rounded-lg bg-blue-50 dark:bg-blue-900">
                        <div class="flex items-center space-x-2">
                            <x-wireui-icon name="clock" class="w-5 h-5 text-blue-500 dark:text-blue-400" />
                            <div class="text-sm font-medium text-gray-800 dark:text-gray-200">Horas Semanales</div>
                        </div>
                        <div class="mt-2 text-lg font-semibold text-gray-900 dark:text-gray-100">
                            {{ number_format($weeklyHours, 2) }} horas
                        </div>
                        <div class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            Distribuidas en {{ collect($daysOfWeek)->filter(fn($_, $day) => $weeklyHours > 0)->count() }} días
                        </div>
                    </div>
                    <div class="p-4 rounded-lg bg-green-50 dark:bg-green-900">
                        <div class="flex items-center space-x-2">
                            <x-wireui-icon name="calendar" class="w-5 h-5 text-green-500 dark:text-green-400" />
                            <div class="text-sm font-medium text-gray-800 dark:text-gray-200">Horas Mensuales Estimadas</div>
                        </div>
                        <div class="mt-2 text-lg font-semibold text-gray-900 dark:text-gray-100">
                            {{ number_format($monthlyHours, 2) }} horas
                        </div>
                        <div class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            Basado en 4.33 semanas por mes
                        </div>
                    </div>
                </div>

                <!-- Encabezado del Calendario solo para pantallas grandes -->
<div class="hidden sm:grid grid-cols-7 gap-2 text-center">
    @foreach($daysOfWeek as $key => $label)
        <div class="p-2 text-sm font-medium text-gray-500 dark:text-gray-400 min-w-0 break-words">
            {{ mb_substr($label, 0, 3) }}
        </div>
    @endforeach
</div>

<!-- Días del Calendario -->
@if($positionSchedule && count($positionSchedule) > 0)
    <div class="grid grid-cols-2 gap-2 mt-2 sm:grid-cols-7">
        @foreach($daysOfWeek as $key => $label)
            @php
                $isSelected = $day_of_week === $key;
                $schedule = $positionSchedule[$key] ?? null;
                $hasHours = $schedule && $schedule->planned_hours > 0;
                $bgColor = $isSelected
                    ? 'bg-blue-100 dark:bg-blue-800 border-blue-500'
                    : ($hasHours ? 'bg-gray-50 dark:bg-gray-800' : 'bg-gray-100 dark:bg-gray-700');
                $cursorClass = $isSelected ? 'cursor-default' : 'cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700';
            @endphp
            <button
                type="button"
                wire:click="selectDay('{{ $key }}')"
                class="relative w-full p-2 text-center transition-colors duration-200 border rounded-lg {{ $bgColor }} {{ $cursorClass }} dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 min-w-0 break-words"
                @if($isSelected) disabled @endif
            >
                <!-- Mostrar nombre completo en móviles -->
                <div class="text-sm font-medium text-gray-900 dark:text-gray-100 sm:hidden">
                    {{ $label }}
                </div>
                <!-- Mostrar nombre abreviado en pantallas grandes -->
                <div class="hidden text-sm font-medium text-gray-900 dark:text-gray-100 sm:block">
                    {{ mb_substr($label, 0, 3) }}
                </div>

                @if($schedule)
                    <div class="mt-1 text-xs font-semibold {{ $isSelected ? 'text-blue-600 dark:text-blue-400' : 'text-gray-600 dark:text-gray-400' }}">
                        {{ number_format($schedule->planned_hours, 2) }}h
                    </div>
                    @if($schedule->observations)
                        <div class="mt-1 text-xs text-gray-500 truncate dark:text-gray-400" title="{{ $schedule->observations }}">
                            {{ Str::limit($schedule->observations, 20) }}
                        </div>
                    @endif
                @endif

                @if($isSelected)
                    <div class="absolute top-0 right-0 w-2 h-2 transform translate-x-1/2 -translate-y-1/2 bg-blue-500 rounded-full"></div>
                @endif
            </button>
        @endforeach
    </div>
@endif



                    <!-- Leyenda -->
                    <div class="flex flex-col items-start pt-4 mt-4 space-y-2 text-xs text-gray-500 border-t border-gray-200 sm:flex-row sm:items-center sm:justify-center sm:space-y-0 sm:space-x-4 dark:border-gray-700 dark:text-gray-400">
                        <div class="flex items-center space-x-1">
                            <div class="w-3 h-3 bg-blue-100 border border-blue-500 rounded dark:bg-blue-800"></div>
                            <span>Día Seleccionado</span>
                        </div>
                        <div class="flex items-center space-x-1">
                            <div class="w-3 h-3 border border-gray-300 rounded bg-gray-50 dark:bg-gray-800 dark:border-gray-600"></div>
                            <span>Con Horario</span>
                        </div>
                        <div class="flex items-center space-x-1">
                            <div class="w-3 h-3 bg-gray-100 border border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600"></div>
                            <span>Sin Horario</span>
                        </div>
                        <div class="flex items-center space-x-1">
                            <div class="w-3 h-3 border border-gray-300 rounded dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700"></div>
                            <span>Click para Seleccionar</span>
                        </div>
                    </div>
                </div>

                <!-- Información Adicional -->
                <div class="p-4 bg-white rounded-lg shadow-sm dark:bg-gray-700/50">
                    <div class="flex items-start space-x-3">
                        <x-wireui-icon name="information-circle" class="w-5 h-5 text-gray-400 mt-0.5" />
                        <div class="space-y-1">
                            <p class="text-gray-600 dark:text-gray-300">
                                Este horario representa el {{ number_format(($weeklyHours / 40) * 100, 1) }}% de una jornada completa (40 horas semanales).
                            </p>
                            @if($weeklyHours > 40)
                                <p class="text-red-600 dark:text-red-400">
                                    <x-wireui-icon name="exclamation" class="inline-block w-4 h-4 mr-1" />
                                    El total de horas semanales excede el límite de 40 horas.
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <x-wireui-errors />

        <!-- Botones -->
        <div class="flex justify-end pt-4 mt-4 space-x-3 border-t border-gray-200 dark:border-gray-700">
            <x-wireui-button white label="Cancelar" wire:click="closeModal" onclick="event.preventDefault();"/>
            <x-wireui-button
                type="submit"
                :label="$editingScheduleId ? 'Actualizar' : 'Guardar'"
                :icon="$editingScheduleId ? 'pencil' : 'plus'"
            />
        </div>
    </form>
</x-modal>