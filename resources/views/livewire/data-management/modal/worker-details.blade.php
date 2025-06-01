<x-modal
    title="Detalles del Trabajador"
    :max-width="'4xl'"
    wire:key="modal-details-{{ $selectedWorker->id ?? '' }}">

    <div class="space-y-6">
        <!-- Información Básica -->
        <div class="p-4 bg-white border border-gray-200 rounded-lg dark:border-gray-700 dark:bg-gray-800/50">
            <h3 class="mb-3 text-sm font-semibold text-gray-700 dark:text-gray-300">Información Personal</h3>
            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                <div>
                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Nombre Completo:</span>
                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $selectedWorker->full_name ?? 'N/A' }}</p>
                </div>
                <div>
                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Cédula:</span>
                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $selectedWorker->identification ?? 'N/A' }}</p>
                </div>
                <div>
                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Email:</span>
                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $selectedWorker->email ?? 'N/A' }}</p>
                </div>
                <div>
                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Teléfono:</span>
                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $selectedWorker->phone ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        {{--
        <!-- Navegación por Pestañas -->
        <div class="p-4 bg-white border border-gray-200 rounded-lg dark:border-gray-700 dark:bg-gray-800/50">
            <h3 class="mb-3 text-sm font-semibold text-gray-700 dark:text-gray-300">Información Laboral</h3>
            <div class="mt-4" x-data="{ activeTab: $persist('posicion') }">
                <!-- Pestañas -->
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <nav class="flex -mb-px space-x-6" aria-label="Tabs">
                        <!-- Pestaña Posición -->
                        <button
                            @click="activeTab = 'posicion'"
                            :class="{ 'border-primary-500 text-primary-600 dark:text-primary-400': activeTab === 'posicion',
                                    'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300': activeTab !== 'posicion' }"
                            class="flex items-center px-1 py-2 text-sm font-medium border-b-2 whitespace-nowrap">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Posición Actual
                        </button>

                        <!-- Pestaña Horario -->
                        <button
                            @click="activeTab = 'horario'"
                            :class="{ 'border-primary-500 text-primary-600 dark:text-primary-400': activeTab === 'horario',
                                    'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300': activeTab !== 'horario' }"
                            class="flex items-center px-1 py-2 text-sm font-medium border-b-2 whitespace-nowrap">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Horario Semanal
                        </button>

                        <!-- Pestaña Comportamiento -->
                        <button
                            @click="activeTab = 'comportamiento'"
                            :class="{ 'border-primary-500 text-primary-600 dark:text-primary-400': activeTab === 'comportamiento',
                                    'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300': activeTab !== 'comportamiento' }"
                            class="flex items-center px-1 py-2 text-sm font-medium border-b-2 whitespace-nowrap">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            Comportamiento
                        </button>
                    </nav>
                </div>

                <!-- Contenido de las Pestañas -->
                <div class="mt-3">
                    <!-- Contenido Posición -->
                    <div x-show="activeTab === 'posicion'" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95">
                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
                            <!-- Área -->
                            <div class="p-3 bg-white rounded-lg shadow dark:bg-gray-800">
                                <div class="flex items-center mb-2 space-x-2">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Área</h4>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $selectedWorker->currentPosition?->area?->name ?? 'N/A' }}</p>
                            </div>

                            <!-- Rol -->
                            <div class="p-3 bg-white rounded-lg shadow dark:bg-gray-800">
                                <div class="flex items-center mb-2 space-x-2">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Rol</h4>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $selectedWorker->currentPosition?->rol?->name ?? 'N/A' }}</p>
                            </div>

                            <!-- Salario Base -->
                            <div class="p-3 bg-white rounded-lg shadow dark:bg-gray-800">
                                <div class="flex items-center mb-2 space-x-2">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Salario Base</h4>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ number_format($selectedWorker->base_salary ?? 0, 2, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Contenido Horario -->
                    <div x-show="activeTab === 'horario'" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95">
                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4">
                            @foreach(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'] as $day)
                                <div class="p-3 bg-white rounded-lg shadow dark:bg-gray-800">
                                    <div class="flex items-center mb-2 space-x-2">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $day }}</h4>
                                    </div>
                                    @php
                                        $schedule = $selectedWorker->weeklySchedule->firstWhere('day_of_week', strtolower($day));
                                    @endphp
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ $schedule ? number_format($schedule->planned_hours, 2) . ' horas' : 'No asignado' }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Contenido Comportamiento -->
                    <div x-show="activeTab === 'comportamiento'" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95">
                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                            <!-- Historial de Comportamiento -->
                            <div class="p-3 bg-white rounded-lg shadow dark:bg-gray-800">
                                <div class="flex items-center mb-2 space-x-2">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Historial de Comportamiento</h4>
                                </div>
                                <div class="space-y-2">
                                    @forelse($selectedWorker->behaviorHistory ?? [] as $history)
                                        <div class="p-2 text-sm rounded-lg bg-gray-50 dark:bg-gray-700">
                                            <div class="flex items-center justify-between">
                                                <span class="font-medium text-gray-900 dark:text-gray-100">{{ $history->date->format('d/m/Y') }}</span>
                                                <span class="text-xs font-semibold {{ $history->status === 'approved' ? 'text-green-600 dark:text-green-400' : ($history->status === 'rejected' ? 'text-red-600 dark:text-red-400' : 'text-yellow-600 dark:text-yellow-400') }}">
                                                    {{ ucfirst($history->status) }}
                                                </span>
                                            </div>
                                            <div class="mt-1 space-y-1">
                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                    <span class="font-medium">Asistencia:</span> {{ $history->attendance_days }} días
                                                </p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                    <span class="font-medium">Faltas:</span> {{ $history->absences }}
                                                </p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                    <span class="font-medium">Permisos:</span> {{ $history->permissions }}
                                                </p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                    <span class="font-medium">Retardos:</span> {{ $history->delays }}
                                                </p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                    <span class="font-medium">Horas Laboradas:</span> {{ number_format($history->labor_hours, 2) }} hrs
                                                </p>
                                                @if($history->observations)
                                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                                        <span class="font-medium">Observaciones:</span> {{ $history->observations }}
                                                    </p>
                                                @endif
                                                @if($history->approver)
                                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                                        <span class="font-medium">Aprobado por:</span> {{ $history->approver->name }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-xs text-center text-gray-500 dark:text-gray-400">No hay registros de comportamiento</p>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Descuentos y Bonificaciones -->
                            <div class="p-3 bg-white rounded-lg shadow dark:bg-gray-800">
                                <div class="flex items-center mb-2 space-x-2">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Descuentos y Bonificaciones</h4>
                                </div>
                                <div class="space-y-2">
                                    @forelse($selectedWorker->discounts ?? [] as $discount)
                                        <div class="p-2 text-sm rounded-lg bg-red-50 dark:bg-red-900/20">
                                            <div class="flex items-center justify-between">
                                                <span class="font-medium text-red-800 dark:text-red-200">{{ $discount->concept }}</span>
                                                <span class="text-xs font-semibold text-red-800 dark:text-red-200">
                                                    {{ number_format($discount->amount, 2, ',', '.') }}
                                                </span>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-xs text-center text-gray-500 dark:text-gray-400">No hay descuentos registrados</p>
                                    @endforelse

                                    @forelse($selectedWorker->bonuses ?? [] as $bonus)
                                        <div class="p-2 text-sm rounded-lg bg-green-50 dark:bg-green-900/20">
                                            <div class="flex items-center justify-between">
                                                <span class="font-medium text-green-800 dark:text-green-200">{{ $bonus->concept }}</span>
                                                <span class="text-xs font-semibold text-green-800 dark:text-green-200">
                                                    {{ number_format($bonus->amount, 2, ',', '.') }}
                                                </span>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-xs text-center text-gray-500 dark:text-gray-400">No hay bonificaciones registradas</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botones -->
        <div class="flex justify-end pt-2 space-x-2 border-t border-gray-200 dark:border-gray-700">
            <x-wireui-button white label="Cerrar" wire:click="closeDetailsModal" onclick="event.preventDefault();"/>
        </div>
        --}}

    </div>
</x-modal>