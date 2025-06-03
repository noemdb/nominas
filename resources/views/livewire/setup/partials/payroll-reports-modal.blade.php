<x-modal
    title="Reportes de Nómina"
    :max-width="'4xl'"
    wire:key="modal-payroll-details-{{ $payrollId }}">

    <div class="space-y-4">
        @if($selectedPayroll)
            <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ $selectedPayroll->name }}
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Período: {{ $selectedPayroll->date_start->format('d/m/Y') }} - {{ $selectedPayroll->date_end->format('d/m/Y') }}
                        </p>
                    </div>
                    <div class="flex items-center space-x-3">

                        @if ($selectedPayroll->status_exchange)
                            <div class="px-4 py-2 text-sm font-semibold text-green-700 bg-green-100 rounded-lg dark:bg-green-900 dark:text-green-200">
                                <div class="flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Moneda de Referencia: USD</span>
                                </div>
                            </div>
                        @else
                            <div class="px-4 py-2 text-sm font-semibold text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-900 dark:text-blue-200">
                                <div class="flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Moneda Local: Bs</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            @if($selectedDetail)
                <div
                    x-data="{ showDetails: true }"
                    class="p-4 mt-4 bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700"
                >
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center space-x-4">
                            <div>
                                <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Detalle del Trabajador: {{ $selectedDetail->worker->full_name }}
                                </h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $selectedDetail->position->area->name }} - {{ $selectedDetail->position->rol->name }}
                                </p>
                            </div>
                        </div>
                        <button
                            wire:click="closeWorkerDetail"
                            class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300"
                            title="Cerrar detalle"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3" >
                        <!-- Días y Horas -->
                        <div class="p-3 rounded-lg bg-gray-50 dark:bg-gray-700">
                            <h5 class="mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Días y Horas</h5>
                            <dl class="space-y-1">
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-500 dark:text-gray-400">Días Trabajados:</dt>
                                    <dd class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $selectedDetail->worked_days }} días</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-500 dark:text-gray-400">Horas Académicas:</dt>
                                    <dd class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $selectedDetail->academic_hours }} hrs</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-500 dark:text-gray-400">Horas Administrativas:</dt>
                                    <dd class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $selectedDetail->administrative_hours }} hrs</dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Ausencias y Permisos -->
                        <div class="p-3 rounded-lg bg-gray-50 dark:bg-gray-700">
                            <h5 class="mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Ausencias y Permisos</h5>
                            <dl class="space-y-1">
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-500 dark:text-gray-400">Reposo Médico:</dt>
                                    <dd class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $selectedDetail->medical_rest_days }} días</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-500 dark:text-gray-400">Permisos Pagados:</dt>
                                    <dd class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $selectedDetail->paid_permission_days }} días</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-500 dark:text-gray-400">Permisos No Pagados:</dt>
                                    <dd class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $selectedDetail->unpaid_permission_days }} días</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-500 dark:text-gray-400">Ausencias Injustificadas:</dt>
                                    <dd class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $selectedDetail->unjustified_absence_days }} días</dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Totales -->
                        <div class="p-3 rounded-lg bg-gray-50 dark:bg-gray-700">
                            <h5 class="mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Totales ({{ $selectedPayroll->currency }})</h5>
                            <dl class="space-y-1">
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-500 dark:text-gray-400">Salario Base:</dt>
                                    <dd class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ number_format($selectedDetail->base_salary_period, 2, ',', '.') }}</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-500 dark:text-gray-400">Total Asignaciones:</dt>
                                    <dd class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ number_format($selectedDetail->total_assignments, 2, ',', '.') }}</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-500 dark:text-gray-400">Total Deducciones:</dt>
                                    <dd class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ number_format($selectedDetail->total_deductions, 2, ',', '.') }}</dd>
                                </div>
                                <div class="flex justify-between pt-1 mt-1 border-t border-gray-200 dark:border-gray-600">
                                    <dt class="text-sm font-medium text-gray-700 dark:text-gray-300">Neto a Pagar:</dt>
                                    <dd class="text-sm font-bold text-gray-900 dark:text-gray-100">{{ number_format($selectedDetail->net_pay, 2, ',', '.') }}</dd>
                                </div>
                            </dl>
                        </div>

                        @if($selectedDetail->observations)
                            <div x-data="{ showObservations: false }" class="w-full mt-4 col-span-full">
                                <button @click="showObservations = !showObservations"
                                    class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium text-left text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                                    <span>Observaciones</span>
                                    <svg class="w-5 h-5 transition-transform"
                                        :class="{ 'rotate-180': showObservations }"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div x-show="showObservations"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                                    x-transition:enter-end="opacity-100 transform translate-y-0"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 transform translate-y-0"
                                    x-transition:leave-end="opacity-0 transform -translate-y-2"
                                    class="w-full p-3 mt-2 rounded-lg bg-gray-50 dark:bg-gray-700 col-span-full">
                                    <p class="text-sm text-gray-600 whitespace-pre-line dark:text-gray-400">{{ $selectedDetail->observations }}</p>
                                </div>
                            </div>
                        @endif
                    </div>


                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                Trabajador
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                Días Trabajados
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                Salario Base
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                Asignaciones
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                Deducciones
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                Neto a Pagar
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-900 dark:divide-gray-700">
                        @forelse($payrollDetails as $detail)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900 uppercase dark:text-gray-100">
                                        {{ $detail->worker->full_name }}
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 ps-1">
                                        {{ $detail->position->area->name }} <br> {{ $detail->position->rol->name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-gray-100">
                                        {{ $detail->worked_days }} días
                                    </div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $detail->academic_hours + $detail->administrative_hours }} horas
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-gray-100">
                                    <div class="space-y-1">
                                        <div class="font-medium">
                                            {{ number_format($detail->base_salary_period, 2, ',', '.') }}
                                            <span class="ml-1 text-xs text-gray-500 dark:text-gray-400">{{ $selectedPayroll->currency }}</span>
                                        </div>
                                        @if ($selectedPayroll->status_exchange)
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                ≈ {{ number_format($detail->base_salary_period * $selectedPayroll->exchange_rate, 2, ',', '.') }} Bs
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-gray-100">
                                    <div class="space-y-1">
                                        <div class="font-medium">
                                            {{ number_format($detail->total_assignments, 2, ',', '.') }}
                                            <span class="ml-1 text-xs text-gray-500 dark:text-gray-400">{{ $selectedPayroll->currency }}</span>
                                        </div>
                                        @if ($selectedPayroll->status_exchange)
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                ≈ {{ number_format($detail->total_assignments * $selectedPayroll->exchange_rate, 2, ',', '.') }} Bs
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-gray-100">
                                    <div class="space-y-1">
                                        <div class="font-medium">
                                            {{ number_format($detail->total_deductions, 2, ',', '.') }}
                                            <span class="ml-1 text-xs text-gray-500 dark:text-gray-400">{{ $selectedPayroll->currency }}</span>
                                        </div>
                                        @if ($selectedPayroll->status_exchange)
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                ≈ {{ number_format($detail->total_deductions * $selectedPayroll->exchange_rate, 2, ',', '.') }} Bs
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-gray-100">
                                    <div class="space-y-1">
                                        <div class="font-medium">
                                            {{ number_format($detail->net_pay, 2, ',', '.') }}
                                            <span class="ml-1 text-xs text-gray-500 dark:text-gray-400">{{ $selectedPayroll->currency }}</span>
                                        </div>
                                        @if ($selectedPayroll->status_exchange)
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                ≈ {{ number_format($detail->net_pay * $selectedPayroll->exchange_rate, 2, ',', '.') }} Bs
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                    <button wire:click="viewWorkerDetail({{ $detail->id }})"
                                        class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300"
                                        title="Ver Detalle"
                                    >
                                        <x-wireui-icon name="information-circle" class="w-5 h-5" />
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-sm text-center text-gray-500 dark:text-gray-400">
                                    No hay detalles registrados para esta nómina
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        @endif
    </div>


    <div class="flex justify-end mt-2 space-x-2">
        <x-wireui-button
            wire:click="closeReportsModal"
            secondary
            label="Cerrar"
        />
        <x-wireui-button
            wire:click="exportToExcel({{ $selectedPayroll->id ?? null }})"
            success
            icon="document-arrow-down"
            label="Exportar a Excel"
            wire:loading.attr="disabled"
            wire:target="exportToExcel"
        />
    </div>

</x-modal>
