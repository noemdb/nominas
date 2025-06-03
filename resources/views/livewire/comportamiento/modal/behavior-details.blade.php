<!-- Modal de detalles del comportamiento -->
<x-modal
    title="Detalles del Comportamiento"
    :max-width="'4xl'"
    wire:key="modal-behavior-details-{{ $selectedBehavior->id ?? '' }}">

    <div class="space-y-6">
        <!-- Información Básica -->

        <div class="p-4 bg-white border border-gray-200 rounded-lg dark:border-gray-700 dark:bg-gray-800/50">
            <h3 class="mb-3 text-sm font-semibold text-gray-700 dark:text-gray-300">Información General</h3>
            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                <div>
                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Trabajador:</span>
                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $selectedBehavior->worker->full_name ?? 'N/A' }}</p>
                </div>
                <div>
                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Fecha:</span>
                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $selectedBehavior->date?->format('d/m/Y') ?? 'N/A' }}</p>
                </div>
                <div>
                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Estado:</span>
                    <p class="text-sm font-medium">
                        <span class="px-2 py-1 rounded-full text-xs font-bold
                            @if($selectedBehavior->status === 'approved') bg-green-200 text-green-800
                            @elseif($selectedBehavior->status === 'rejected') bg-red-200 text-red-800
                            @else bg-yellow-200 text-yellow-800
                            @endif">
                            {{ ucfirst($selectedBehavior->status ?? 'N/A') }}
                        </span>
                    </p>
                </div>
                @if($selectedBehavior->approver)
                    <div>
                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Aprobado por:</span>
                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $selectedBehavior->approver->name }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Nómina Asociada -->
        @if($selectedBehavior->payrolls->isNotEmpty())
            <div class="p-4 bg-white border border-gray-200 rounded-lg dark:border-gray-700 dark:bg-gray-800/50">
                <h3 class="mb-4 text-sm font-semibold text-gray-700 dark:text-gray-300">Nómina Asociada</h3>
                <div class="w-full">
                    @foreach($selectedBehavior->payrolls as $payroll)
                        <div class="w-full p-4 mb-4 bg-white rounded-lg shadow last:mb-0 dark:bg-gray-800">
                            <!-- Encabezado de la Nómina -->
                            <div class="flex items-center justify-between pb-3 mb-4 border-b border-gray-200 dark:border-gray-700">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <h4 class="text-base font-medium text-gray-900 dark:text-gray-100">{{ $payroll->name }}</h4>
                                </div>
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold
                                    @if($payroll->status_approved) bg-green-200 text-green-800
                                    @elseif(!$payroll->status_active) bg-red-200 text-red-800
                                    @else bg-yellow-200 text-yellow-800
                                    @endif">
                                    {{ $payroll->status_approved ? 'Aprobada' : ($payroll->status_active ? 'Activa' : 'Inactiva') }}
                                </span>
                            </div>

                            <!-- Información Principal -->
                            <div class="grid w-full grid-cols-1 gap-6 sm:grid-cols-2">
                                <!-- Columna Izquierda -->
                                <div class="space-y-4">
                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                        <div>
                                            <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Período:</span>
                                            <p class="text-sm text-gray-900 dark:text-gray-100">
                                                {{ $payroll->date_start->format('d/m/Y') }} - {{ $payroll->date_end->format('d/m/Y') }}
                                            </p>
                                        </div>
                                        <div>
                                            <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Tipo de Nómina:</span>
                                            <p class="text-sm text-gray-900 dark:text-gray-100">
                                                {{ ucfirst($payroll->type ?? 'Regular') }}
                                            </p>
                                        </div>
                                        <div>
                                            <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Fecha de Creación:</span>
                                            <p class="text-sm text-gray-900 dark:text-gray-100">
                                                {{ $payroll->created_at->format('d/m/Y H:i') }}
                                            </p>
                                        </div>
                                        @if($payroll->approved_at)
                                            <div>
                                                <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Fecha de Aprobación:</span>
                                                <p class="text-sm text-gray-900 dark:text-gray-100">
                                                    {{ $payroll->approved_at->format('d/m/Y H:i') }}
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Columna Derecha -->
                                <div class="space-y-4">
                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                        <div>
                                            <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Bonificación Aplicada:</span>
                                            <p class="text-sm font-medium text-green-600 dark:text-green-400">
                                                {{ number_format($payroll->pivot->bonus_amount ?? 0, 2, ',', '.') }}
                                            </p>
                                        </div>
                                        <div>
                                            <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Descuento Aplicado:</span>
                                            <p class="text-sm font-medium text-red-600 dark:text-red-400">
                                                {{ number_format($payroll->pivot->discount_amount ?? 0, 2, ',', '.') }}
                                            </p>
                                        </div>
                                        <div>
                                            <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Total Trabajadores:</span>
                                            <p class="text-sm text-gray-900 dark:text-gray-100">
                                                {{ $payroll->workers_count ?? 'N/A' }}
                                            </p>
                                        </div>
                                        @if($payroll->approved_by)
                                            <div>
                                                <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Aprobado por:</span>
                                                <p class="text-sm text-gray-900 dark:text-gray-100">
                                                    {{ $payroll->approver->name ?? 'N/A' }}
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Observaciones -->
                            @if($payroll->observations)
                                <div class="pt-3 mt-4 border-t border-gray-200 dark:border-gray-700">
                                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Observaciones:</span>
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $payroll->observations }}</p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Navegación por Pestañas -->
        <div class="p-4 bg-white border border-gray-200 rounded-lg dark:border-gray-700 dark:bg-gray-800/50">
            <h3 class="mb-3 text-sm font-semibold text-gray-700 dark:text-gray-300">Detalles del Comportamiento</h3>
            <div class="mt-4" x-data="{ activeTab: $persist('asistencia') }">
                <!-- Pestañas -->
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <nav class="flex -mb-px space-x-6" aria-label="Tabs">
                        <!-- Pestaña Asistencia -->
                        <button
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
                <div class="mt-3">
                    <!-- Contenido Asistencia -->
                    <div x-show="activeTab === 'asistencia'" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95">
                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
                            <!-- Asistencia -->
                            <div class="p-3 bg-white rounded-lg shadow dark:bg-gray-800">
                                <div class="flex items-center mb-2 space-x-2">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Asistencia</h4>
                                </div>
                                <div class="space-y-2">
                                    <div>
                                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Días de Asistencia:</span>
                                        <p class="text-sm text-gray-900 dark:text-gray-100">{{ $selectedBehavior->attendance_days ?? 0 }} días</p>
                                    </div>
                                    <div>
                                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Faltas:</span>
                                        <p class="text-sm text-gray-900 dark:text-gray-100">{{ $selectedBehavior->absences ?? 0 }}</p>
                                    </div>
                                    <div>
                                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Retardos:</span>
                                        <p class="text-sm text-gray-900 dark:text-gray-100">{{ $selectedBehavior->delays ?? 0 }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Horas Laboradas -->
                            <div class="p-3 bg-white rounded-lg shadow dark:bg-gray-800">
                                <div class="flex items-center mb-2 space-x-2">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Horas Laboradas</h4>
                                </div>
                                <div class="space-y-2">
                                    <div>
                                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Horas Laboradas:</span>
                                        <p class="text-sm text-gray-900 dark:text-gray-100">{{ number_format($selectedBehavior->labor_hours ?? 0, 2) }} hrs</p>
                                    </div>
                                    <div>
                                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Horas Administrativas:</span>
                                        <p class="text-sm text-gray-900 dark:text-gray-100">{{ number_format($selectedBehavior->administrative_hours ?? 0, 2) }} hrs</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Resumen -->
                            <div class="p-3 bg-white rounded-lg shadow dark:bg-gray-800">
                                <div class="flex items-center mb-2 space-x-2">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Resumen</h4>
                                </div>
                                <div class="space-y-2">
                                    <div>
                                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Total Horas:</span>
                                        <p class="text-sm text-gray-900 dark:text-gray-100">
                                            {{ number_format(($selectedBehavior->labor_hours ?? 0) + ($selectedBehavior->administrative_hours ?? 0), 2) }} hrs
                                        </p>
                                    </div>
                                    <div>
                                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Días Trabajados:</span>
                                        <p class="text-sm text-gray-900 dark:text-gray-100">
                                            {{ ($selectedBehavior->attendance_days ?? 0) + ($selectedBehavior->absences ?? 0) }} días
                                        </p>
                                    </div>
                                </div>
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
                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                            <!-- Permisos -->
                            <div class="p-3 bg-white rounded-lg shadow dark:bg-gray-800">
                                <div class="flex items-center mb-2 space-x-2">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Permisos</h4>
                                </div>
                                <div class="space-y-2">
                                    <div>
                                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Permisos Pagados:</span>
                                        <p class="text-sm text-gray-900 dark:text-gray-100">
                                            {{ $selectedBehavior->paid_permission_days ?? 0 }} días ({{ number_format($selectedBehavior->paid_permission_hours ?? 0, 2) }} hrs)
                                        </p>
                                    </div>
                                    <div>
                                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Permisos No Pagados:</span>
                                        <p class="text-sm text-gray-900 dark:text-gray-100">
                                            {{ $selectedBehavior->unpaid_permission_days ?? 0 }} días ({{ number_format($selectedBehavior->unpaid_permission_hours ?? 0, 2) }} hrs)
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Ausencias y Reposo -->
                            <div class="p-3 bg-white rounded-lg shadow dark:bg-gray-800">
                                <div class="flex items-center mb-2 space-x-2">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Ausencias y Reposo</h4>
                                </div>
                                <div class="space-y-2">
                                    <div>
                                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Reposo Médico:</span>
                                        <p class="text-sm text-gray-900 dark:text-gray-100">
                                            {{ $selectedBehavior->medical_rest_days ?? 0 }} días ({{ number_format($selectedBehavior->medical_rest_hours ?? 0, 2) }} hrs)
                                        </p>
                                    </div>
                                    <div>
                                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Faltas Injustificadas:</span>
                                        <p class="text-sm text-gray-900 dark:text-gray-100">
                                            {{ $selectedBehavior->unjustified_absence_days ?? 0 }} días ({{ number_format($selectedBehavior->unjustified_absence_hours ?? 0, 2) }} hrs)
                                        </p>
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
                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                            <!-- Bonificaciones -->
                            <div class="p-3 bg-white rounded-lg shadow dark:bg-gray-800">
                                <div class="flex items-center mb-2 space-x-2">
                                    <svg class="w-4 h-4 text-green-500 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Bonificaciones</h4>
                                </div>
                                <div class="space-y-2">
                                    <div>
                                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Bonificación:</span>
                                        <p class="text-sm font-medium text-green-600 dark:text-green-400">
                                            {{ number_format($selectedBehavior->bonus ?? 0, 2, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Descuentos -->
                            <div class="p-3 bg-white rounded-lg shadow dark:bg-gray-800">
                                <div class="flex items-center mb-2 space-x-2">
                                    <svg class="w-4 h-4 text-red-500 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Descuentos</h4>
                                </div>
                                <div class="space-y-2">
                                    <div>
                                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Descuento:</span>
                                        <p class="text-sm font-medium text-red-600 dark:text-red-400">
                                            {{ number_format($selectedBehavior->discount ?? 0, 2, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Observaciones -->
        @if($selectedBehavior->observations)
            <div class="p-4 bg-white border border-gray-200 rounded-lg dark:border-gray-700 dark:bg-gray-800/50">
                <h3 class="mb-3 text-sm font-semibold text-gray-700 dark:text-gray-300">Observaciones</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $selectedBehavior->observations }}</p>
            </div>
        @endif

        {{--

        <!-- Botones -->
        <div class="flex justify-end pt-2 space-x-2 border-t border-gray-200 dark:border-gray-700">
            <x-wireui-button white label="Cerrar" wire:click="closeDetailsModal" onclick="event.preventDefault();"/>
        </div>
        --}}
    </div>
</x-modal>
