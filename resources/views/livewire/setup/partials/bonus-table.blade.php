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
                    <div class="flex items-start space-x-1">
                        <span>Monto/Porcentaje</span>
                    </div>
                </th>
                <th class="hidden px-1 py-3 sm:table-cell">
                    <div class="flex items-center space-x-1">
                        <span>Moneda</span>
                    </div>
                </th>
                <th class="hidden px-6 py-3 sm:table-cell">
                    <div class="flex items-center space-x-1">
                        <span>Estado Activo</span>
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
            @foreach ($bonuses as $bonus)
                <tr class="border-t border-gray-200 dark:border-gray-700">
                    <td class="block px-6 py-4 sm:table-cell">
                        <span class="font-bold sm:hidden">Nombre:</span>
                        <div class="block max-w-[200px]">
                            <div class="text-sm font-medium text-gray-200">{{ $bonus->name }}</div>
                            <div class="text-sm text-gray-400">{{ $bonus->description }}</div>
                        </div>
                    </td>
                    <td class="block px-6 py-4 sm:table-cell">
                        <span class="font-bold sm:hidden">Tipo:</span>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $bonus->type === 'fijo' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ ucfirst($bonus->type) }}
                        </span>
                    </td>
                    {{-- <td class="block px-6 py-4 sm:table-cell">
                        <span class="font-bold sm:hidden">Monto/Porcentaje:</span>
                        <span class="truncate block max-w-[150px]">
                            @if ($bonus->type === 'fijo')
                                Bs. {{ number_format($bonus->amount, 2) }}
                            @else
                                {{ $bonus->percentage }}%
                            @endif
                        </span>
                    </td> --}}

                    <td class="block sm:table-cell">
                        <span class="font-bold sm:hidden">Monto/Porcentaje:</span>
                        <span class="block">
                            @if ($bonus->type === 'fijo')
                                Bs. {{ number_format($bonus->amount, 2) }}
                            @else
                                @php
                                    $function = collect(\App\Models\Bonus::FUNCTIONS)
                                        ->firstWhere('value', $bonus->name_function);
                                @endphp
                                <span class="block font-semibold text-gray-200 text-md">Formula</span>
                                <span class="block text-sm"> {{ $function['label'] ?? $bonus->description }}</span>
                                <span class="block text-xs text-gray-400">{!! $function['example'] ?? '' !!}</span>
                            @endif
                        </span>
                    </td>
                    <td class="block px-6 py-4 sm:table-cell">
                        <span class="font-bold sm:hidden">Moneda:</span>
                        <div class="flex items-center">
                            <div class="relative group">
                                <svg class="w-5 h-5 {{ $bonus->status_exchange ? 'text-yellow-500' : 'text-gray-400' }}"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        x-tooltip.raw="{{ $bonus->status_exchange ? 'En moneda USD' : 'En moneda local' }}">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="ml-2 text-sm text-gray-500">
                                {{ $bonus->status_exchange ? 'USD' : 'Bs.' }}
                            </span>
                        </div>
                    </td>
                    <td class="block px-6 py-4 sm:table-cell">
                        <span class="font-bold sm:hidden">Estado Activo:</span>
                        @if ($bonus->status_active)
                            <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Activo</span>
                        @else
                            <span class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">Inactivo</span>
                        @endif
                    </td>
                    <td class="block px-6 py-4 sm:table-cell">
                        <span class="font-bold sm:hidden">Aplicabilidad:</span>
                        <span class="truncate block max-w-[150px]">
                            @if ($bonus->institution_id)
                                Institución
                            @elseif ($bonus->area_id)
                                Área
                            @elseif ($bonus->rol_id)
                                Rol
                            @elseif ($bonus->position_id)
                                Posición
                            @elseif ($bonus->worker_id)
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
                                wire:click="edit({{ $bonus->id }})"
                                wire:loading.attr="disabled"
                                wire:target="edit({{ $bonus->id }})"
                                :disabled="$bonus->isUsedInPayroll()"
                                x-tooltip.raw="{{ $bonus->isUsedInPayroll() ? 'No se puede editar, la bonificación está asociada a una nómina.' : 'Editar bonificación' }}" />
                            <x-wireui-mini-button
                                info
                                icon="eye"
                                class="rounded-none"
                                wire:click="viewDetails({{ $bonus->id }})"
                                wire:loading.attr="disabled"
                                wire:target="viewDetails({{ $bonus->id }})"
                                x-tooltip.raw="Ver detalles de la bonificación" />
                            <x-wireui-mini-button
                                primary
                                icon="document-duplicate"
                                class="rounded-none"
                                wire:click="confirmClone({{ $bonus->id }})"
                                wire:loading.attr="disabled"
                                wire:target="confirmClone({{ $bonus->id }})"
                                :disabled="$bonus->isUsedInPayroll()"
                                x-tooltip.raw="{{ $bonus->isUsedInPayroll() ? 'No se puede clonar, la bonificación está asociada a una nómina.' : 'Clonar bonificación' }}" />
                            <x-wireui-mini-button
                                negative
                                icon="trash"
                                class="rounded-b-md sm:rounded-r-md sm:rounded-tl-none sm:rounded-bl-none"
                                wire:click="confirmDelete({{ $bonus->id }})"
                                wire:loading.attr="disabled"
                                wire:target="delete({{ $bonus->id }})"
                                :disabled="$bonus->isUsedInPayroll()"
                                x-tooltip.raw="{{ $bonus->isUsedInPayroll() ? 'No se puede eliminar, la bonificación está asociada a una nómina.' : 'Eliminar bonificación' }}" />
                        </div>
                    </td>
                </tr>
            @endforeach

            @if ($bonuses->count() === 0)
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                        No se encontraron bonificaciones
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $bonuses->links() }}
</div>
