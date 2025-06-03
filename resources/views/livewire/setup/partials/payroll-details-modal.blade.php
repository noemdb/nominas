<!-- Modal para ver detalles de la nómina -->
<x-modal
    title="Detalles de la Nómina"
    :max-width="'4xl'"
    wire:key="modal-details-{{ $payrollId }}">

    <div class="space-y-6">
        <!-- Información Básica -->
        <div class="p-4 bg-white border border-gray-200 rounded-lg dark:border-gray-700 dark:bg-gray-800/50">
            <h3 class="mb-3 text-sm font-semibold text-gray-700 dark:text-gray-300">Información Básica</h3>
            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                <div>
                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Nombre:</span>
                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $payrollName }}</p>
                </div>
                <div>
                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Período:</span>
                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                        {{ \Carbon\Carbon::parse($dateStart)->format('d/m/Y') }} -
                        {{ \Carbon\Carbon::parse($dateEnd)->format('d/m/Y') }}
                    </p>
                </div>
                <div>
                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Días Laborables:</span>
                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $payroll->num_days ?? 0 }} días</p>
                </div>
                <div>
                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Moneda:</span>
                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                        {{ $payroll->status_exchange ? 'USD (Moneda Referencial)' : 'Moneda Local' }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Navegación por Pestañas -->
        <div class="p-4 bg-white border border-gray-200 rounded-lg dark:border-gray-700 dark:bg-gray-800/50">
            <h3 class="mb-3 text-sm font-semibold text-gray-700 dark:text-gray-300">Conceptos de la Nómina</h3>
            <div class="mt-4" x-data="{ activeTab: $persist('descuentos') }">
                <!-- Pestañas -->
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <nav class="flex -mb-px space-x-6" aria-label="Tabs">
                        <!-- Pestaña Descuentos -->
                        <button
                            @click="activeTab = 'descuentos'"
                            :class="{ 'border-primary-500 text-primary-600 dark:text-primary-400': activeTab === 'descuentos',
                                    'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300': activeTab !== 'descuentos' }"
                            class="flex items-center px-1 py-2 text-sm font-medium border-b-2 whitespace-nowrap">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Descuentos
                        </button>

                        <!-- Pestaña Deducciones -->
                        <button
                            @click="activeTab = 'deducciones'"
                            :class="{ 'border-primary-500 text-primary-600 dark:text-primary-400': activeTab === 'deducciones',
                                    'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300': activeTab !== 'deducciones' }"
                            class="flex items-center px-1 py-2 text-sm font-medium border-b-2 whitespace-nowrap">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            Deducciones
                        </button>

                        <!-- Pestaña Asignaciones -->
                        <button
                            @click="activeTab = 'bonificaciones'"
                            :class="{ 'border-primary-500 text-primary-600 dark:text-primary-400': activeTab === 'bonificaciones',
                                    'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300': activeTab !== 'bonificaciones' }"
                            class="flex items-center px-1 py-2 text-sm font-medium border-b-2 whitespace-nowrap">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                            </svg>
                            Asignaciones
                        </button>
                    </nav>
                </div>

                <!-- Contenido de las Pestañas -->
                <div class="mt-3">
                    <!-- Contenido Descuentos -->
                    <div x-show="activeTab === 'descuentos'" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95">
                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4">
                            <!-- Descuentos por Institución -->
                            <div class="p-3 bg-white rounded-lg shadow dark:bg-gray-800">
                                <div class="flex items-center mb-2 space-x-2">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Descuentos por Institución</h4>
                                </div>
                                <div class="space-y-2">
                                    @forelse($payroll->discounts->whereNotNull('institution_id') as $discount)
                                        <div class="p-2 text-sm rounded-lg bg-gray-50 dark:bg-gray-700">
                                            <div class="flex items-center justify-between">
                                                <span class="font-medium text-gray-900 dark:text-gray-100">{{ $discount->name }}</span>
                                                <span class="text-xs font-semibold {{ $discount->type === 'fijo' ? 'text-blue-600 dark:text-blue-400' : 'text-purple-600 dark:text-purple-400' }}">
                                                    {{ $discount->type === 'fijo' ? number_format($discount->amount, 2) : $discount->name_function }}
                                                </span>
                                            </div>
                                            @if($discount->description)
                                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $discount->description }}
                                                    @if($discount->institution_name)
                                                        <div class="text-xs text-gray-500 dark:text-gray-400">Institución: {{ $discount->institution_name }}</div>
                                                    @endif
                                                </p>
                                            @endif
                                        </div>
                                    @empty
                                        <p class="text-xs text-center text-gray-500 dark:text-gray-400">No hay descuentos por institución</p>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Descuentos por Área -->
                            <div class="p-3 bg-white rounded-lg shadow dark:bg-gray-800">
                                <div class="flex items-center mb-2 space-x-2">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Descuentos por Área</h4>
                                </div>
                                <div class="space-y-2">
                                    @forelse($payroll->discounts->whereNotNull('area_id') as $discount)
                                        <div class="p-2 text-sm rounded-lg bg-gray-50 dark:bg-gray-700">
                                            <div class="flex items-center justify-between">
                                                <span class="font-medium text-gray-900 dark:text-gray-100">{{ $discount->name }}</span>
                                                <span class="text-xs font-semibold {{ $discount->type === 'fijo' ? 'text-blue-600 dark:text-blue-400' : 'text-purple-600 dark:text-purple-400' }}">
                                                    {{ $discount->type === 'fijo' ? number_format($discount->amount, 2) : $discount->name_function }}
                                                </span>
                                            </div>
                                            @if($discount->description)
                                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $discount->description }}
                                                    @if($discount->area_name)
                                                        <div class="text-xs text-gray-500 dark:text-gray-400">Área: {{ $discount->area_name }}</div>
                                                    @endif
                                                </p>
                                            @endif
                                        </div>
                                    @empty
                                        <p class="text-xs text-center text-gray-500 dark:text-gray-400">No hay descuentos por área</p>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Descuentos por Rol -->
                            <div class="p-3 bg-white rounded-lg shadow dark:bg-gray-800">
                                <div class="flex items-center mb-2 space-x-2">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Descuentos por Rol</h4>
                                </div>
                                <div class="space-y-2">
                                    @forelse($payroll->discounts->whereNotNull('rol_id') as $discount)
                                        <div class="p-2 text-sm rounded-lg bg-gray-50 dark:bg-gray-700">
                                            <div class="flex items-center justify-between">
                                                <span class="font-medium text-gray-900 dark:text-gray-100">{{ $discount->name }}</span>
                                                <span class="text-xs font-semibold {{ $discount->type === 'fijo' ? 'text-blue-600 dark:text-blue-400' : 'text-purple-600 dark:text-purple-400' }}">
                                                    {{ $discount->type === 'fijo' ? number_format($discount->amount, 2) : $discount->name_function }}
                                                </span>
                                            </div>
                                            @if($discount->description)
                                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $discount->description }}
                                                    @if($discount->rol_name)
                                                        <div class="text-xs text-gray-500 dark:text-gray-400">Rol: {{ $discount->rol_name }}</div>
                                                    @endif
                                                </p>
                                            @endif
                                        </div>
                                    @empty
                                        <p class="text-xs text-center text-gray-500 dark:text-gray-400">No hay descuentos por rol</p>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Descuentos por Trabajador -->
                            <div class="p-3 bg-white rounded-lg shadow dark:bg-gray-800">
                                <div class="flex items-center mb-2 space-x-2">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Descuentos por Trabajador</h4>
                                </div>
                                <div class="space-y-2">
                                    @forelse($payroll->discounts->whereNotNull('worker_id') as $discount)
                                        <div class="p-2 text-sm rounded-lg bg-gray-50 dark:bg-gray-700">
                                            <div class="flex items-center justify-between">
                                                <span class="font-medium text-gray-900 dark:text-gray-100">{{ $discount->name }}</span>
                                                <span class="text-xs font-semibold {{ $discount->type === 'fijo' ? 'text-blue-600 dark:text-blue-400' : 'text-purple-600 dark:text-purple-400' }}">
                                                    {{ $discount->type === 'fijo' ? number_format($discount->amount, 2) : $discount->name_function }}
                                                </span>
                                            </div>
                                            @if($discount->description)
                                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $discount->description }}
                                                    @if($discount->worker_name)
                                                        <div class="text-xs text-gray-500 dark:text-gray-400">Trabajador: {{ $discount->worker_name }}</div>
                                                    @endif
                                                </p>
                                            @endif
                                        </div>
                                    @empty
                                        <p class="text-xs text-center text-gray-500 dark:text-gray-400">No hay descuentos por trabajador</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contenido Deducciones -->
                    <div x-show="activeTab === 'deducciones'" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95">
                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4">
                            <!-- Deducciones por Institución -->
                            <div class="p-3 bg-white rounded-lg shadow dark:bg-gray-800">
                                <div class="flex items-center mb-2 space-x-2">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Deducciones por Institución</h4>
                                </div>
                                <div class="space-y-2">
                                    @forelse($payroll->deductions->whereNotNull('institution_id') as $deduction)
                                        <div class="p-2 text-sm rounded-lg bg-gray-50 dark:bg-gray-700">
                                            <div class="flex items-center justify-between">
                                                <span class="font-medium text-gray-900 dark:text-gray-100">{{ $deduction->name }}</span>
                                                <span class="text-xs font-semibold {{ $deduction->type === 'fijo' ? 'text-blue-600 dark:text-blue-400' : 'text-purple-600 dark:text-purple-400' }}">
                                                    {{ $deduction->type === 'fijo' ? number_format($deduction->amount, 2) : $deduction->name_function }}
                                                </span>
                                            </div>
                                            @if($deduction->description)
                                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $deduction->description }}
                                                </p>
                                            @endif
                                        </div>
                                    @empty
                                        <p class="text-xs text-center text-gray-500 dark:text-gray-400">No hay deducciones por institución</p>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Deducciones por Área -->
                            <div class="p-3 bg-white rounded-lg shadow dark:bg-gray-800">
                                <div class="flex items-center mb-2 space-x-2">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Deducciones por Área</h4>
                                </div>
                                <div class="space-y-2">
                                    @forelse($payroll->deductions->whereNotNull('area_id') as $deduction)
                                        <div class="p-2 text-sm rounded-lg bg-gray-50 dark:bg-gray-700">
                                            <div class="flex items-center justify-between">
                                                <span class="font-medium text-gray-900 dark:text-gray-100">{{ $deduction->name }}</span>
                                                <span class="text-xs font-semibold {{ $deduction->type === 'fijo' ? 'text-blue-600 dark:text-blue-400' : 'text-purple-600 dark:text-purple-400' }}">
                                                    {{ $deduction->type === 'fijo' ? number_format($deduction->amount, 2) : $deduction->name_function }}
                                                </span>
                                            </div>
                                            @if($deduction->description)
                                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $deduction->description }}
                                                    @if($deduction->area_name)
                                                        <div class="text-xs text-gray-500 dark:text-gray-400">Área: {{ $deduction->area_name }}</div>
                                                    @endif
                                                </p>
                                            @endif
                                        </div>
                                    @empty
                                        <p class="text-xs text-center text-gray-500 dark:text-gray-400">No hay deducciones por área</p>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Deducciones por Rol -->
                            <div class="p-3 bg-white rounded-lg shadow dark:bg-gray-800">
                                <div class="flex items-center mb-2 space-x-2">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Deducciones por Rol</h4>
                                </div>
                                <div class="space-y-2">
                                    @forelse($payroll->deductions->whereNotNull('rol_id') as $deduction)
                                        <div class="p-2 text-sm rounded-lg bg-gray-50 dark:bg-gray-700">
                                            <div class="flex items-center justify-between">
                                                <span class="font-medium text-gray-900 dark:text-gray-100">{{ $deduction->name }}</span>
                                                <span class="text-xs font-semibold {{ $deduction->type === 'fijo' ? 'text-blue-600 dark:text-blue-400' : 'text-purple-600 dark:text-purple-400' }}">
                                                    {{ $deduction->type === 'fijo' ? number_format($deduction->amount, 2) : $deduction->name_function }}
                                                </span>
                                            </div>
                                            @if($deduction->description)
                                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $deduction->description }}
                                                    @if($deduction->rol_name)
                                                        <div class="text-xs text-gray-500 dark:text-gray-400">Rol: {{ $deduction->rol_name }}</div>
                                                    @endif
                                                </p>
                                            @endif
                                        </div>
                                    @empty
                                        <p class="text-xs text-center text-gray-500 dark:text-gray-400">No hay deducciones por rol</p>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Deducciones por Trabajador -->
                            <div class="p-3 bg-white rounded-lg shadow dark:bg-gray-800">
                                <div class="flex items-center mb-2 space-x-2">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Deducciones por Trabajador</h4>
                                </div>
                                <div class="space-y-2">
                                    @forelse($payroll->deductions->whereNotNull('worker_id') as $deduction)
                                        <div class="p-2 text-sm rounded-lg bg-gray-50 dark:bg-gray-700">
                                            <div class="flex items-center justify-between">
                                                <span class="font-medium text-gray-900 dark:text-gray-100">{{ $deduction->name }}</span>
                                                <span class="text-xs font-semibold {{ $deduction->type === 'fijo' ? 'text-blue-600 dark:text-blue-400' : 'text-purple-600 dark:text-purple-400' }}">
                                                    {{ $deduction->type === 'fijo' ? number_format($deduction->amount, 2) : $deduction->name_function }}
                                                </span>
                                            </div>
                                            @if($deduction->description)
                                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $deduction->description }}
                                                    @if($deduction->worker_name)
                                                        <div class="text-xs text-gray-500 dark:text-gray-400 first-line: border-top">Trabajador: {{ $deduction->worker_name }}</div>
                                                    @endif
                                                </p>
                                            @endif
                                        </div>
                                    @empty
                                        <p class="text-xs text-center text-gray-500 dark:text-gray-400">No hay deducciones por trabajador</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contenido Asignaciones -->
                    <div x-show="activeTab === 'bonificaciones'" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95">
                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4">
                            <!-- Asignaciones por Institución -->
                            <div class="p-3 bg-white rounded-lg shadow dark:bg-gray-800">
                                <div class="flex items-center mb-2 space-x-2">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Asignaciones por Institución</h4>
                                </div>
                                <div class="space-y-2">
                                    @forelse($payroll->bonuses->whereNotNull('institution_id') as $bonus)
                                        <div class="p-2 text-sm rounded-lg bg-gray-50 dark:bg-gray-700">
                                            <div class="flex items-center justify-between">
                                                <span class="font-medium text-gray-900 dark:text-gray-100">{{ $bonus->name }}</span>
                                                <span class="text-xs font-semibold {{ $bonus->type === 'fijo' ? 'text-blue-600 dark:text-blue-400' : 'text-purple-600 dark:text-purple-400' }}">
                                                    {{ $bonus->type === 'fijo' ? number_format($bonus->amount, 2) : $bonus->name_function }}
                                                </span>
                                            </div>
                                            @if($bonus->description)
                                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $bonus->description }}
                                                    @if($bonus->institution_name)
                                                        <div class="text-xs text-gray-500 dark:text-gray-400">Institución: {{ $bonus->institution_name }}</div>
                                                    @endif
                                                </p>
                                            @endif
                                        </div>
                                    @empty
                                        <p class="text-xs text-center text-gray-500 dark:text-gray-400">No hay bonificaciones por institución</p>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Asignaciones por Área -->
                            <div class="p-3 bg-white rounded-lg shadow dark:bg-gray-800">
                                <div class="flex items-center mb-2 space-x-2">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Asignaciones por Área</h4>
                                </div>
                                <div class="space-y-2">
                                    @forelse($payroll->bonuses->whereNotNull('area_id') as $bonus)
                                        <div class="p-2 text-sm rounded-lg bg-gray-50 dark:bg-gray-700">
                                            <div class="flex items-center justify-between">
                                                <span class="font-medium text-gray-900 dark:text-gray-100">{{ $bonus->name }}</span>
                                                <span class="text-xs font-semibold {{ $bonus->type === 'fijo' ? 'text-blue-600 dark:text-blue-400' : 'text-purple-600 dark:text-purple-400' }}">
                                                    {{ $bonus->type === 'fijo' ? number_format($bonus->amount, 2) : $bonus->name_function }}
                                                </span>
                                            </div>
                                            @if($bonus->description)
                                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $bonus->description }}
                                                    @if($bonus->area_name)
                                                        <div class="text-xs text-gray-500 dark:text-gray-400">Área: {{ $bonus->area_name }}</div>
                                                    @endif
                                                </p>
                                            @endif
                                        </div>
                                    @empty
                                        <p class="text-xs text-center text-gray-500 dark:text-gray-400">No hay bonificaciones por área</p>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Asignaciones por Rol -->
                            <div class="p-3 bg-white rounded-lg shadow dark:bg-gray-800">
                                <div class="flex items-center mb-2 space-x-2">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Asignaciones por Rol</h4>
                                </div>
                                <div class="space-y-2">
                                    @forelse($payroll->bonuses->whereNotNull('rol_id') as $bonus)
                                        <div class="p-2 text-sm rounded-lg bg-gray-50 dark:bg-gray-700">
                                            <div class="flex items-center justify-between">
                                                <span class="font-medium text-gray-900 dark:text-gray-100">{{ $bonus->name }}</span>
                                                <span class="text-xs font-semibold {{ $bonus->type === 'fijo' ? 'text-blue-600 dark:text-blue-400' : 'text-purple-600 dark:text-purple-400' }}">
                                                    {{ $bonus->type === 'fijo' ? number_format($bonus->amount, 2) : $bonus->name_function }}
                                                </span>
                                            </div>
                                            @if($bonus->description)
                                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $bonus->description }}
                                                    @if($bonus->rol_name)
                                                        <div class="text-xs text-gray-500 dark:text-gray-400">Rol: {{ $bonus->rol_name }}</div>
                                                    @endif
                                                </p>
                                            @endif
                                        </div>
                                    @empty
                                        <p class="text-xs text-center text-gray-500 dark:text-gray-400">No hay bonificaciones por rol</p>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Asignaciones por Trabajador -->
                            <div class="p-3 bg-white rounded-lg shadow dark:bg-gray-800">
                                <div class="flex items-center mb-2 space-x-2">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Asignaciones por Trabajador</h4>
                                </div>
                                <div class="space-y-2">
                                    @forelse($payroll->bonuses->whereNotNull('worker_id') as $bonus)
                                        <div class="p-2 text-sm rounded-lg bg-gray-50 dark:bg-gray-700">
                                            <div class="flex items-center justify-between">
                                                <span class="font-medium text-gray-900 dark:text-gray-100">{{ $bonus->name }}</span>
                                                <span class="text-xs font-semibold {{ $bonus->type === 'fijo' ? 'text-blue-600 dark:text-blue-400' : 'text-purple-600 dark:text-purple-400' }}">
                                                    {{ $bonus->type === 'fijo' ? number_format($bonus->amount, 2) : $bonus->name_function }}
                                                </span>
                                            </div>
                                            @if($bonus->description)
                                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $bonus->description }}
                                                    @if($bonus->worker_name)
                                                        <div class="text-xs text-gray-500 dark:text-gray-400">Trabajador: {{ $bonus->worker_name }}</div>
                                                    @endif
                                                </p>
                                            @endif
                                        </div>
                                    @empty
                                        <p class="text-xs text-center text-gray-500 dark:text-gray-400">No hay bonificaciones por trabajador</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Descripción y Observaciones -->
        @if($payroll->description || $payroll->observations)
            <div class="p-4 bg-white border border-gray-200 rounded-lg dark:border-gray-700 dark:bg-gray-800/50">
                <h3 class="mb-3 text-sm font-semibold text-gray-700 dark:text-gray-300">Información Adicional</h3>
                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                    @if($payroll->description)
                        <div class="p-3 rounded-lg bg-gray-50 dark:bg-gray-800">
                            <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Descripción:</span>
                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $payroll->description }}</p>
                        </div>
                    @endif
                    @if($payroll->observations)
                        <div class="p-3 rounded-lg bg-gray-50 dark:bg-gray-800">
                            <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Observaciones:</span>
                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $payroll->observations }}</p>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <!-- Estados de la Nómina -->
        <div class="p-4 bg-white border border-gray-200 rounded-lg dark:border-gray-700 dark:bg-gray-800/50">
            <h3 class="mb-3 text-sm font-semibold text-gray-700 dark:text-gray-300">Estados de la nómina</h3>
            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                <!-- Estado Activo -->
                <div class="p-3 rounded-lg bg-gray-50 dark:bg-gray-800">
                    <div class="flex items-center space-x-2">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 {{ $payroll->status_active ? 'text-green-500' : 'text-red-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Estado Activo</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $payroll->status_active ? 'La nómina está activa y en proceso' : 'La nómina está inactiva' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Estado Público -->
                <div class="p-3 rounded-lg bg-gray-50 dark:bg-gray-800">
                    <div class="flex items-center space-x-2">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 {{ $payroll->status_public ? 'text-blue-500' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Visibilidad</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $payroll->status_public ? 'La nómina es visible para los trabajadores' : 'La nómina es privada' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Estado Aprobado -->
                <div class="p-3 rounded-lg bg-gray-50 dark:bg-gray-800">
                    <div class="flex items-center space-x-2">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 {{ $payroll->status_approved ? 'text-green-500' : 'text-yellow-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Aprobación</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $payroll->status_approved ? 'La nómina ha sido aprobada' : 'La nómina está pendiente de aprobación' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Estado de Moneda -->
                <div class="p-3 rounded-lg bg-gray-50 dark:bg-gray-800">
                    <div class="flex items-center space-x-2">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 {{ $payroll->status_exchange ? 'text-yellow-500' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Tipo de Moneda</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $payroll->status_exchange ? 'La nómina está en moneda referencial (USD)' : 'La nómina está en moneda local' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resumen de Cálculos -->
        <div class="p-4 space-y-4 rounded-lg bg-gray-50 dark:bg-gray-800">
            <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Resumen de Cálculos</h4>

            @php
                $summary = $payroll->payroll_summary;
            @endphp

            <div class="grid grid-cols-2 gap-4 sm:grid-cols-3">
                <!-- Total Trabajadores -->
                <div class="p-3 bg-white rounded-lg shadow-sm dark:bg-gray-700">
                    <div class="flex flex-col">
                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Total Trabajadores</span>
                        <span class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $summary['total_workers'] }}</span>
                    </div>
                </div>

                <!-- Total Devengado -->
                <div class="p-3 bg-white rounded-lg shadow-sm dark:bg-gray-700">
                    <div class="flex flex-col">
                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Total Devengado</span>
                        <span class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                            {{ $payroll->currency }} {{ number_format($summary['total_earned'], 2) }}
                        </span>
                    </div>
                </div>

                <!-- Total Neto -->
                <div class="p-3 bg-white rounded-lg shadow-sm dark:bg-gray-700">
                    <div class="flex flex-col">
                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Total Neto</span>
                        <span class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                            {{ $payroll->currency }} {{ number_format($summary['total_net_pay'], 2) }}
                        </span>
                    </div>
                </div>

                <!-- Total Asignaciones -->
                <div class="p-3 bg-white rounded-lg shadow-sm dark:bg-gray-700">
                    <div class="flex flex-col">
                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Total Asignaciones</span>
                        <span class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                            {{ $payroll->currency }} {{ number_format($summary['total_assignments'], 2) }}
                        </span>
                    </div>
                </div>

                <!-- Total Descuentos -->
                <div class="p-3 bg-white rounded-lg shadow-sm dark:bg-gray-700">
                    <div class="flex flex-col">
                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Total Descuentos</span>
                        <span class="text-lg font-semibold text-red-600 dark:text-red-400">
                            {{ $payroll->currency }} {{ number_format($summary['total_discounts'], 2) }}
                        </span>
                    </div>
                </div>

                <!-- Total Deducciones -->
                <div class="p-3 bg-white rounded-lg shadow-sm dark:bg-gray-700">
                    <div class="flex flex-col">
                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Total Deducciones</span>
                        <span class="text-lg font-semibold text-red-600 dark:text-red-400">
                            {{ $payroll->currency }} {{ number_format($summary['total_deductions'], 2) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botones -->
        <div class="flex justify-end pt-2 space-x-2 border-t border-gray-200 dark:border-gray-700">
            <x-wireui-button white label="Cerrar" wire:click="closeDetailsModal" onclick="event.preventDefault();"/>
        </div>
    </div>
</x-modal>
