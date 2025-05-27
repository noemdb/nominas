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
                        <span>Aplicabilidad</span>
                    </div>
                </th>
                <th class="hidden px-6 py-3 sm:table-cell">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($deductions as $deduction)
                <tr class="border-t border-gray-200 dark:border-gray-700">
                    <td class="block px-6 py-4 sm:table-cell">
                        <span class="font-bold sm:hidden">Nombre:</span>
                        <div class="truncate block max-w-[200px]">
                            <div class="text-sm font-medium text-gray-900">{{ $deduction->name }}</div>
                            <div class="text-sm text-gray-500">{{ $deduction->description }}</div>
                        </div>
                    </td>
                    <td class="block px-6 py-4 sm:table-cell">
                        <span class="font-bold sm:hidden">Tipo:</span>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $deduction->type === 'fijo' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ ucfirst($deduction->type) }}
                        </span>
                    </td>
                    <td class="block px-6 py-4 sm:table-cell">
                        <span class="font-bold sm:hidden">Monto/Porcentaje:</span>
                        <span class="truncate block max-w-[150px]">
                            @if ($deduction->type === 'fijo')
                                Bs. {{ number_format($deduction->amount, 2) }}
                            @else
                                {{ $deduction->name_function }}%
                            @endif
                        </span>
                    </td>
                    <td class="block px-6 py-4 sm:table-cell">
                        <span class="font-bold sm:hidden">Aplicabilidad:</span>
                        <span class="truncate block max-w-[150px]">
                            @if ($deduction->institution_id)
                                Institución
                            @elseif ($deduction->area_id)
                                Área
                            @elseif ($deduction->rol_id)
                                Rol
                            @elseif ($deduction->position_id)
                                Posición
                            @elseif ($deduction->worker_id)
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
                                wire:click="edit({{ $deduction->id }})"
                                wire:loading.attr="disabled"
                                wire:target="edit({{ $deduction->id }})"
                                x-tooltip.raw="Editar deducción" />
                            <x-wireui-mini-button
                                negative
                                icon="trash"
                                class="rounded-b-md sm:rounded-r-md sm:rounded-tl-none sm:rounded-bl-none"
                                wire:click="delete({{ $deduction->id }})"
                                wire:loading.attr="disabled"
                                wire:target="delete({{ $deduction->id }})"
                                x-tooltip.raw="Eliminar deducción" />
                        </div>
                    </td>
                </tr>
            @endforeach

            @if ($deductions->count() === 0)
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        No se encontraron deducciones
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $deductions->links() }}
</div>
