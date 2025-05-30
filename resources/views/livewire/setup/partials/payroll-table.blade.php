<div class="w-full h-full overflow-x-auto">
    <table class="w-full h-full text-left border-collapse">
        <thead class="bg-gray-50 dark:bg-gray-800">
            <tr>
                <th wire:click="sortBy('name')" class="hidden px-6 py-3 cursor-pointer sm:table-cell">
                    <div class="flex items-center space-x-1">
                        <span>Nombre</span>
                        @if ($sortField === 'name')
                            <span>{!! $sortDirection === 'asc' ? '&#8593;' : '&#8595;' !!}</span>
                        @endif
                    </div>
                </th>
                <th wire:click="sortBy('date_start')" class="hidden px-6 py-3 cursor-pointer sm:table-cell">
                    <div class="flex items-center space-x-1">
                        <span>Período</span>
                        @if ($sortField === 'date_start')
                            <span>{!! $sortDirection === 'asc' ? '&#8593;' : '&#8595;' !!}</span>
                        @endif
                    </div>
                </th>
                {{-- <th wire:click="sortBy('num_days')" class="hidden px-6 py-3 cursor-pointer sm:table-cell">
                    <div class="flex items-center space-x-1">
                        <span>Días</span>
                        @if ($sortField === 'num_days')
                            <span>{!! $sortDirection === 'asc' ? '&#8593;' : '&#8595;' !!}</span>
                        @endif
                    </div>
                </th> --}}
                <th class="hidden px-6 py-3 sm:table-cell">
                    <div class="flex items-center space-x-1">
                        <span>Conceptos</span>
                    </div>
                </th>
                <th class="hidden px-6 py-3 sm:table-cell">
                    <div class="flex items-center space-x-1">
                        <span>Estados</span>
                    </div>
                </th>
                <th class="hidden px-6 py-3 sm:table-cell">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($payrolls as $payroll)
                <tr class="border-t border-gray-200 dark:border-gray-700">

                    <td class="block px-6 py-4 sm:table-cell">
                        <span class="font-bold sm:hidden">Nombre:</span>
                        <div class="text-wrap block max-w-[200px]">
                            <div class="text-sm font-medium text-gray-200">{{ $payroll->name }}</div>
                            <small class="text-xs text-gray-400"">{{ $payroll->description }}</small>
                        </div>
                    </td>

                    <td class="block px-6 py-4 sm:table-cell">
                        <span class="font-bold sm:hidden">Período:</span>
                        <div class="text-sm text-gray-500 max-w-[200px]">
                            Del {{ $payroll->date_start->translatedFormat('d \d\e F \d\e Y') }} al {{ $payroll->date_end->translatedFormat('d \d\e F \d\e Y') }}
                            <div class="mt-1 font-medium text-md text-primary-600 dark:text-primary-400">
                                {{ $payroll->num_days }} {{ Str::plural('día', $payroll->num_days) }}
                            </div>
                            <small class="text-xs text-gray-400"">{{ $payroll->date_end->diffForHumans() }}</small>
                        </div>
                    </td>

                    {{-- <td class="block px-6 py-4 sm:table-cell">
                        <span class="font-bold sm:hidden">Días:</span>
                        <span class="truncate block max-w-[150px]">{{ $payroll->num_days }}</span>
                    </td> --}}

                    <td class="block px-6 py-4 sm:table-cell">
                        <span class="font-bold text-gray-700 sm:hidden dark:text-gray-300">Conceptos:</span>
                        <div class="block max-w-[250px] bg-gray-50 dark:bg-gray-800/50 rounded-lg p-3">
                            <div class="grid grid-cols-1 gap-2 text-sm">
                                <div class="flex items-center justify-between p-2 bg-white rounded-md shadow-sm dark:bg-gray-700/50">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                        </svg>
                                        <span class="text-gray-700 dark:text-gray-300">Descuentos</span>
                                    </div>
                                    <span class="font-semibold text-red-600 dark:text-red-400">{{ $payroll->discounts()->count() }}</span>
                                </div>
                                <div class="flex items-center justify-between p-2 bg-white rounded-md shadow-sm dark:bg-gray-700/50">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                        </svg>
                                        <span class="text-gray-700 dark:text-gray-300">Deducciones</span>
                                    </div>
                                    <span class="font-semibold text-yellow-600 dark:text-yellow-400">{{ $payroll->deductions()->count() }}</span>
                                </div>
                                <div class="flex items-center justify-between p-2 bg-white rounded-md shadow-sm dark:bg-gray-700/50">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                        <span class="text-gray-700 dark:text-gray-300">Asignaciones</span>
                                    </div>
                                    <span class="font-semibold text-green-600 dark:text-green-400">{{ $payroll->bonuses()->count() }}</span>
                                </div>
                            </div>
                            <div class="pt-2 mt-2 border-t border-gray-200 dark:border-gray-700">
                                <div class="flex items-center justify-between text-xs">
                                    <span class="text-gray-500 dark:text-gray-400">Total conceptos:</span>
                                    <span class="font-semibold text-gray-700 dark:text-gray-300">
                                        {{ $payroll->discounts()->count() + $payroll->deductions()->count() + $payroll->bonuses()->count() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </td>

                    <td class="block px-6 py-4 sm:table-cell">
                        <span class="font-bold text-gray-700 sm:hidden dark:text-gray-300">Estados:</span>
                        <div class="block max-w-[250px] bg-gray-50 dark:bg-gray-800/50 rounded-lg p-3">
                            <div class="grid grid-cols-1 gap-2 text-sm">
                                <!-- Status Exchange -->
                                <div class="flex items-center justify-between p-2 bg-white rounded-md shadow-sm dark:bg-gray-700/50">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 {{ $payroll->status_exchange ? 'text-yellow-500' : 'text-gray-400' }} mr-2"
                                             fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                             x-tooltip.raw="{{ $payroll->status_exchange ? 'En moneda USD' : 'En moneda local' }}">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="text-gray-700 dark:text-gray-300">Moneda USD</span>
                                    </div>
                                    <span class="font-semibold {{ $payroll->status_exchange ? 'text-yellow-600 dark:text-yellow-400' : 'text-gray-500 dark:text-gray-400' }}">
                                        {{ $payroll->status_exchange ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </div>

                                <!-- Status Active -->
                                <div class="flex items-center justify-between p-2 bg-white rounded-md shadow-sm dark:bg-gray-700/50">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 {{ $payroll->status_active ? 'text-green-500' : 'text-red-500' }} mr-2"
                                             fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                             x-tooltip.raw="{{ $payroll->status_active ? 'Activa' : 'Inactiva' }}">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="text-gray-700 dark:text-gray-300">Activa</span>
                                    </div>
                                    <span class="font-semibold {{ $payroll->status_active ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                        {{ $payroll->status_active ? 'Sí' : 'No' }}
                                    </span>
                                </div>

                                <!-- Status Public -->
                                <div class="flex items-center justify-between p-2 bg-white rounded-md shadow-sm dark:bg-gray-700/50">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 {{ $payroll->status_public ? 'text-blue-500' : 'text-gray-400' }} mr-2"
                                             fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                             x-tooltip.raw="{{ $payroll->status_public ? 'Pública' : 'Privada' }}">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <span class="text-gray-700 dark:text-gray-300">Pública</span>
                                    </div>
                                    <span class="font-semibold {{ $payroll->status_public ? 'text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-gray-400' }}">
                                        {{ $payroll->status_public ? 'Sí' : 'No' }}
                                    </span>
                                </div>

                                <!-- Status Approved -->
                                <div class="flex items-center justify-between p-2 bg-white rounded-md shadow-sm dark:bg-gray-700/50">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 {{ $payroll->status_approved ? 'text-green-500' : 'text-gray-400' }} mr-2"
                                             fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                             x-tooltip.raw="{{ $payroll->status_approved ? 'Aprobada' : 'Pendiente de aprobación' }}">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                        <span class="text-gray-700 dark:text-gray-300">Aprobada</span>
                                    </div>
                                    <span class="font-semibold {{ $payroll->status_approved ? 'text-green-600 dark:text-green-400' : 'text-gray-500 dark:text-gray-400' }}">
                                        {{ $payroll->status_approved ? 'Sí' : 'No' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </td>

                    <td class="relative flex px-6 py-4 space-x-2 sm:table-cell">

                        <x-wireui-dropdown icon="arrow-up" position="left" icon="bars-3">

                            <x-wireui-dropdown.item
                            label="Ver detalles"
                            icon="eye"
                            wire:target="viewDetails({{ $payroll->id }})"
                            wire:click="viewDetails({{ $payroll->id }})"
                            wire:loading.attr="disabled"/>

                            <x-wireui-dropdown.item
                            icon="pencil"
                            label="Editar nómina"
                            wire:click="edit({{ $payroll->id }})"
                            wire:target="edit({{ $payroll->id }})"
                            wire:loading.attr="disabled"/>

                            <x-wireui-dropdown.item
                            icon="document-duplicate"
                            label="Clonar nómina"
                            wire:click="confirmClone({{ $payroll->id }})"
                            wire:loading.attr="disabled"
                            wire:target="confirmClone({{ $payroll->id }})" />

                            <x-wireui-dropdown.item
                            separator
                            icon="server-stack"
                            label="Generar Estructura"
                            wire:click="generateStructure({{ $payroll->id }})"
                            wire:loading.attr="disabled"
                            wire:target="generateStructure({{ $payroll->id }})" />

                            <x-wireui-dropdown.item
                            separator
                            icon="trash"
                            label="Limpiar Estructura"
                            wire:click="confirmClearStructure({{ $payroll->id }})"
                            wire:loading.attr="disabled"
                            wire:target="confirmClearStructure({{ $payroll->id }})"
                            class="text-orange-600 hover:text-orange-700 dark:text-orange-500 dark:hover:text-orange-400" />

                            <x-wireui-dropdown.item
                            icon="calculator"
                            label="Calcular nómina"
                            wire:click="calculate({{ $payroll->id }})"
                            wire:loading.attr="disabled"
                            wire:target="calculate({{ $payroll->id }})" />

                            <x-wireui-dropdown.item
                            icon="document"
                            label="Reportes"
                            {{-- wire:click="calculate({{ $payroll->id }})" --}}
                            wire:loading.attr="disabled"
                            wire:target="calculate({{ $payroll->id }})" />

                        </x-wireui-dropdown>

                    </td>

                </tr>
            @endforeach
            @if ($payrolls->count() === 0)
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                        No se encontraron nóminas.
                    </td>
                </tr>
            @endif
        </tbody>

    </table>
</div>
<div class="w-full mt-4">
    {{ $payrolls->links() }}
</div>
