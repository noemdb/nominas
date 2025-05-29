<!-- Modal para ver detalles de bonificación -->
<x-modal
    title="Detalles de Bonificación"
    :max-width="'2xl'"
    wire:model="showDetailsModal">

    @if ($bonusDetails)
        <div class="space-y-6">
            <!-- Sección de Información Básica -->
            <div class="p-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800/50 dark:border-gray-700">
                <div class="flex items-center mb-4 space-x-2">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Información Básica</h4>
                </div>
                <div class="space-y-3 pl-7">
                    <p class="flex items-center space-x-2">
                        <span class="w-32 text-sm font-medium text-gray-500 dark:text-gray-400">Nombre:</span>
                        <span class="text-sm text-gray-900 dark:text-gray-100">{{ $bonusDetails->name }}</span>
                    </p>
                    <p class="flex items-start space-x-2">
                        <span class="w-32 text-sm font-medium text-gray-500 dark:text-gray-400">Descripción:</span>
                        <span class="text-sm text-gray-900 dark:text-gray-100">{{ $bonusDetails->description ?? 'N/A' }}</span>
                    </p>
                    <p class="flex items-center space-x-2">
                        <span class="w-32 text-sm font-medium text-gray-500 dark:text-gray-400">Tipo:</span>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $bonusDetails->type === 'fijo' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ ucfirst($bonusDetails->type) }}
                        </span>
                    </p>
                    @if ($bonusDetails->type === 'fijo')
                        <p class="flex items-center space-x-2">
                            <span class="w-32 text-sm font-medium text-gray-500 dark:text-gray-400">Monto:</span>
                            <span class="text-sm text-gray-900 dark:text-gray-100">Bs. {{ number_format($bonusDetails->amount, 2) }}</span>
                        </p>
                    @else
                        <p class="flex items-center space-x-2">
                            <span class="w-32 text-sm font-medium text-gray-500 dark:text-gray-400">Función:</span>
                            <span class="text-sm text-gray-900 dark:text-gray-100">{{ $bonusDetails->name_function ?? 'N/A' }}</span>
                        </p>
                    @endif
                    <p class="flex items-center space-x-2">
                        <span class="w-32 text-sm font-medium text-gray-500 dark:text-gray-400">Moneda:</span>
                        <span class="flex items-center">
                            <svg class="w-4 h-4 {{ $bonusDetails->status_exchange ? 'text-yellow-500' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="ml-1 text-sm text-gray-900 dark:text-gray-100">{{ $bonusDetails->status_exchange ? 'USD' : 'Bs.' }}</span>
                        </span>
                    </p>
                    <p class="flex items-center space-x-2">
                        <span class="w-32 text-sm font-medium text-gray-500 dark:text-gray-400">Estado:</span>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $bonusDetails->status_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $bonusDetails->status_active ? 'Activo' : 'Inactivo' }}
                        </span>
                    </p>
                </div>
            </div>

            <!-- Sección de Aplicabilidad -->
            <div class="p-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800/50 dark:border-gray-700">
                <div class="flex items-center mb-4 space-x-2">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Aplicabilidad</h4>
                </div>
                <div class="space-y-3 pl-7">
                    <p class="flex items-center space-x-2">
                        <span class="w-32 text-sm font-medium text-gray-500 dark:text-gray-400">Institución:</span>
                        <span class="text-sm text-gray-900 dark:text-gray-100">{{ $bonusDetails->institution ? $bonusDetails->institution->name : 'No aplica' }}</span>
                    </p>
                    <p class="flex items-center space-x-2">
                        <span class="w-32 text-sm font-medium text-gray-500 dark:text-gray-400">Área:</span>
                        <span class="text-sm text-gray-900 dark:text-gray-100">{{ $bonusDetails->area ? $bonusDetails->area->name : 'No aplica' }}</span>
                    </p>
                    <p class="flex items-center space-x-2">
                        <span class="w-32 text-sm font-medium text-gray-500 dark:text-gray-400">Rol:</span>
                        <span class="text-sm text-gray-900 dark:text-gray-100">{{ $bonusDetails->rol ? $bonusDetails->rol->name : 'No aplica' }}</span>
                    </p>
                    <p class="flex items-center space-x-2">
                        <span class="w-32 text-sm font-medium text-gray-500 dark:text-gray-400">Posición:</span>
                        <span class="text-sm text-gray-900 dark:text-gray-100">{{ $bonusDetails->position ? $bonusDetails->position->name : 'No aplica' }}</span>
                    </p>
                    <p class="flex items-center space-x-2">
                        <span class="w-32 text-sm font-medium text-gray-500 dark:text-gray-400">Trabajador:</span>
                        <span class="text-sm text-gray-900 dark:text-gray-100">{{ $bonusDetails->worker ? $bonusDetails->worker->full_name : 'No aplica' }}</span>
                    </p>
                </div>
            </div>

            <!-- Sección de Nóminas Asociadas -->
            <div class="p-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800/50 dark:border-gray-700">
                <div class="flex items-center mb-4 space-x-2">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Nóminas Asociadas</h4>
                </div>
                <div class="pl-7">
                    <x-payroll-details-table :payrolls="$bonusDetails->payrolls" />
                </div>
            </div>
        </div>
    @endif

    <div class="flex justify-end mt-6">
        <x-wireui-button white label="Cerrar" wire:click="closeDetailsModal" />
    </div>
</x-modal>
