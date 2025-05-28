<div class="overflow-x-auto">
    <table class="w-full text-left border-collapse">
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
                        <span>Fecha Inicio</span>
                        @if ($sortField === 'date_start')
                            <span>{!! $sortDirection === 'asc' ? '&#8593;' : '&#8595;' !!}</span>
                        @endif
                    </div>
                </th>
                <th wire:click="sortBy('date_end')" class="hidden px-6 py-3 cursor-pointer sm:table-cell">
                    <div class="flex items-center space-x-1">
                        <span>Fecha Fin</span>
                        @if ($sortField === 'date_end')
                            <span>{!! $sortDirection === 'asc' ? '&#8593;' : '&#8595;' !!}</span>
                        @endif
                    </div>
                </th>
                <th wire:click="sortBy('num_days')" class="hidden px-6 py-3 cursor-pointer sm:table-cell">
                    <div class="flex items-center space-x-1">
                        <span>Días</span>
                        @if ($sortField === 'num_days')
                            <span>{!! $sortDirection === 'asc' ? '&#8593;' : '&#8595;' !!}</span>
                        @endif
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
                        <div class=" text-wrap block max-w-[200px]">
                            <div class="text-sm font-medium text-gray-200">{{ $payroll->name }}</div>
                            <small class="text-xs text-gray-400"">{{ $payroll->description }}</small>
                        </div>
                    </td>

                    <td class="block px-6 py-4 sm:table-cell">
                        <span class="font-bold sm:hidden">Fecha Inicio:</span>
                        <span class="truncate block max-w-[150px]">{{ $payroll->date_start->format('Y-m-d') }}</span>
                    </td>

                    <td class="block px-6 py-4 sm:table-cell">
                        <span class="font-bold sm:hidden">Fecha Fin:</span>
                        <span class="truncate block max-w-[150px]">{{ $payroll->date_end->format('Y-m-d') }}</span>
                    </td>

                    <td class="block px-6 py-4 sm:table-cell">
                        <span class="font-bold sm:hidden">Días:</span>
                        <span class="truncate block max-w-[150px]">{{ $payroll->num_days }}</span>
                    </td>

                    <td class="block px-6 py-4 sm:table-cell">
                        <span class="font-bold sm:hidden">Estados:</span>
                        <div class="flex items-center space-x-2">
                            <!-- Status Exchange -->
                            <div class="relative group">
                                <svg class="w-5 h-5 {{ $payroll->status_exchange ? 'text-yellow-500' : 'text-gray-400' }}"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     x-tooltip.raw="{{ $payroll->status_exchange ? 'En moneda USD' : 'En moneda local' }}">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>

                            <!-- Status Active -->
                            <div class="relative group">
                                <svg class="w-5 h-5 {{ $payroll->status_active ? 'text-green-500' : 'text-red-500' }}"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     x-tooltip.raw="{{ $payroll->status_active ? 'Activa' : 'Inactiva' }}">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>

                            <!-- Status Public -->
                            <div class="relative group">
                                <svg class="w-5 h-5 {{ $payroll->status_public ? 'text-blue-500' : 'text-gray-400' }}"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     x-tooltip.raw="{{ $payroll->status_public ? 'Pública' : 'Privada' }}">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </div>

                            <!-- Status Approved -->
                            <div class="relative group">
                                <svg class="w-5 h-5 {{ $payroll->status_approved ? 'text-green-500' : 'text-gray-400' }}"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     x-tooltip.raw="{{ $payroll->status_approved ? 'Aprobada' : 'Pendiente de aprobación' }}">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                        </div>
                    </td>

                    <td class="flex px-6 py-4 space-x-2 sm:table-cell">
                        <span class="font-bold sm:hidden">Acciones:</span>
                        <x-wireui-dropdown>
                            <x-slot name="trigger">
                                <x-wireui-button flat icon="ellipsis-vertical" />
                            </x-slot>

                            <x-wireui-dropdown.item
                                icon="eye"
                                label="Ver detalles"
                                wire:click="viewDetails({{ $payroll->id }})"
                                wire:loading.attr="disabled"
                                wire:target="viewDetails({{ $payroll->id }})" />

                            <x-wireui-dropdown.item
                                icon="pencil"
                                label="Editar nómina"
                                wire:click="edit({{ $payroll->id }})"
                                wire:loading.attr="disabled"
                                wire:target="edit({{ $payroll->id }})" />

                            {{-- <x-wireui-dropdown.separator /> --}}

                            <x-wireui-dropdown.item
                                icon="server-stack"
                                label="Generar Estructura"
                                wire:click="generateStructure({{ $payroll->id }})"
                                wire:loading.attr="disabled"
                                wire:target="generateStructure({{ $payroll->id }})" />

                            <x-wireui-dropdown.item
                                icon="calculator"
                                label="Calcular nómina"
                                wire:click="calculate({{ $payroll->id }})"
                                wire:loading.attr="disabled"
                                wire:target="calculate({{ $payroll->id }})" />

                            {{-- <x-wireui-dropdown.separator /> --}}

                            <x-wireui-dropdown.item
                                icon="document-duplicate"
                                label="Clonar nómina"
                                wire:click="confirmClone({{ $payroll->id }})"
                                wire:loading.attr="disabled"
                                wire:target="confirmClone({{ $payroll->id }})" />

                            {{-- <x-wireui-dropdown.separator /> --}}

                            <x-wireui-dropdown.item
                                icon="trash"
                                label="Eliminar nómina"
                                wire:click="confirmDelete({{ $payroll->id }})"
                                wire:loading.attr="disabled"
                                wire:target="confirmDelete({{ $payroll->id }})"
                                class="text-red-600 hover:text-red-700 dark:text-red-500 dark:hover:text-red-400" />
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
<div class="mt-4">
    {{ $payrolls->links() }}
</div>
