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
                <th class="hidden px-6 py-3 sm:table-cell">
                    <div class="flex items-center space-x-1">
                        <span>Tipo</span>
                    </div>
                </th>
                <th class="hidden px-6 py-3 sm:table-cell">
                    <div class="flex items-center space-x-1">
                        <span>Monto/Porcentaje</span>
                    </div>
                </th>
                <th class="hidden px-6 py-3 sm:table-cell">
                    <div class="flex items-center space-x-1">
                        <span>Estado Activo</span>
                    </div>
                </th>
                <th class="hidden px-6 py-3 sm:table-cell">
                    <div class="flex items-center space-x-1">
                        <span>Moneda</span>
                    </div>
                </th>
                <th class="hidden px-6 py-3 sm:table-cell">
                    <div class="flex items-center space-x-1">
                        <span>Aplicabilidad</span>
                    </div>
                </th>
                <th class="hidden px-6 py-3 sm:table-cell">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($discounts as $discount)
                <tr class="border-t border-gray-200 dark:border-gray-700">
                    <td class="block px-6 py-4 sm:table-cell">
                        <span class="font-bold sm:hidden">Nombre:</span>
                        <div class="block max-w-[200px]">
                            <div class="text-sm font-medium text-gray-900">{{ $discount->name }}</div>
                            <div class="text-sm text-gray-500">{{ $discount->description }}</div>
                        </div>
                    </td>
                    <td class="block px-6 py-4 sm:table-cell">
                        <span class="font-bold sm:hidden">Tipo:</span>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $discount->type === 'fijo' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ ucfirst($discount->type) }}
                        </span>
                    </td>
                    <td class="block px-6 py-4 sm:table-cell">
                        <span class="font-bold sm:hidden">Monto/Porcentaje:</span>
                        <span class="truncate block max-w-[150px]">
                            @if ($discount->type === 'fijo')
                                {{ $discount->status_exchange ? 'USD' : 'Bs.' }} {{ number_format($discount->amount, 2) }}
                            @else
                                {{ $discount->percentage }}% ({{ $discount->name_function }})
                            @endif
                        </span>
                    </td>
                    <td class="block px-6 py-4 sm:table-cell">
                        <span class="font-bold sm:hidden">Estado Activo:</span>
                        @if ($discount->status_active)
                            <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Activo</span>
                        @else
                            <span class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">Inactivo</span>
                        @endif
                    </td>
                    <td class="block px-6 py-4 sm:table-cell">
                        <span class="font-bold sm:hidden">Moneda:</span>
                        <div class="flex items-center">
                            <div class="relative group">
                                <svg class="w-5 h-5 {{ $discount->status_exchange ? 'text-yellow-500' : 'text-gray-400' }}"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    x-tooltip.raw="{{ $discount->status_exchange ? 'En moneda USD' : 'En moneda local' }}">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="ml-2 text-sm text-gray-500">
                                {{ $discount->status_exchange ? 'USD' : 'Bs.' }}
                            </span>
                        </div>
                    </td>
                    <td class="block px-6 py-4 sm:table-cell">
                        <span class="font-bold sm:hidden">Aplicabilidad:</span>
                        <span class="truncate block max-w-[150px]">
                            @if ($discount->institution_id)
                                Institución
                            @elseif ($discount->area_id)
                                Área
                            @elseif ($discount->rol_id)
                                Rol
                            @elseif ($discount->position_id)
                                Posición
                            @elseif ($discount->worker_id)
                                Trabajador
                            @endif
                        </span>
                    </td>
                    <td class="flex px-6 py-4 space-x-2 sm:table-cell">
                        <span class="font-bold sm:hidden">Acciones:</span>
                        <div class="flex flex-row rounded-md shadow-sm" role="group">
                            <x-wireui-mini-button
                                warning
                                icon="pencil"
                                class="rounded-t-md sm:rounded-l-md sm:rounded-tr-none sm:rounded-br-none"
                                wire:click="edit({{ $discount->id }})"
                                wire:loading.attr="disabled"
                                wire:target="edit({{ $discount->id }})"
                                :disabled="$discount->isUsedInPayroll()"
                                x-tooltip.raw="{{ $discount->isUsedInPayroll() ? 'No se puede editar, el descuento está asociado a una nómina.' : 'Editar descuento' }}" />
                            <x-wireui-mini-button
                                info
                                icon="eye"
                                class="rounded-none"
                                wire:click="viewDetails({{ $discount->id }})"
                                wire:loading.attr="disabled"
                                wire:target="viewDetails({{ $discount->id }})"
                                x-tooltip.raw="Ver detalles del descuento" />
                            <x-wireui-mini-button
                                primary
                                icon="document-duplicate"
                                class="rounded-none"
                                wire:click="confirmClone({{ $discount->id }})"
                                wire:loading.attr="disabled"
                                wire:target="confirmClone({{ $discount->id }})"
                                :disabled="$discount->isUsedInPayroll()"
                                x-tooltip.raw="{{ $discount->isUsedInPayroll() ? 'No se puede clonar, el descuento está asociado a una nómina.' : 'Clonar descuento' }}" />
                            <x-wireui-mini-button
                                negative
                                icon="trash"
                                class="rounded-b-md sm:rounded-r-md sm:rounded-tl-none sm:rounded-bl-none"
                                wire:click="confirmDelete({{ $discount->id }})"
                                wire:loading.attr="disabled"
                                wire:target="delete({{ $discount->id }})"
                                :disabled="$discount->isUsedInPayroll()"
                                x-tooltip.raw="{{ $discount->isUsedInPayroll() ? 'No se puede eliminar, el descuento está asociado a una nómina.' : 'Eliminar descuento' }}" />
                        </div>
                    </td>
                </tr>
            @endforeach

            @if ($discounts->count() === 0)
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                        No se encontraron descuentos
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $discounts->links() }}
</div>
