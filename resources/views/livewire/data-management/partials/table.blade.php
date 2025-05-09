<div class="overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50 dark:bg-gray-800">
            <tr>
                <th wire:click="sortBy('first_name')"
                    class="hidden px-6 py-3 text-gray-600 cursor-pointer dark:text-gray-400 sm:table-cell">
                    Nombre
                    @if ($sortField === 'first_name')
                        <span>{!! $sortDirection === 'asc' ? '&#8593;' : '&#8595;' !!}</span>
                    @endif
                </th>
                <th wire:click="sortBy('identification')" class="hidden px-6 py-3 cursor-pointer sm:table-cell">
                    Cédula
                    @if ($sortField === 'identification')
                        <span>{!! $sortDirection === 'asc' ? '&#8593;' : '&#8595;' !!}</span>
                    @endif
                </th>
                <th wire:click="sortBy('current_position_info')" class="hidden px-6 py-3 cursor-pointer sm:table-cell">
                    Área/Roll
                    @if ($sortField === 'current_position_info')
                        <span>{!! $sortDirection === 'asc' ? '&#8593;' : '&#8595;' !!}</span>
                    @endif
                </th>
                <th wire:click="sortBy('base_salary')" class="hidden px-6 py-3 cursor-pointer sm:table-cell">
                    Salario
                    @if ($sortField === 'base_salary')
                        <span>{!! $sortDirection === 'asc' ? '&#8593;' : '&#8595;' !!}</span>
                    @endif
                </th>
                <th wire:click="sortBy('is_active')" class="hidden px-6 py-3 cursor-pointer sm:table-cell">
                    Estado
                    @if ($sortField === 'is_active')
                        <span>{!! $sortDirection === 'asc' ? '&#8593;' : '&#8595;' !!}</span>
                    @endif
                </th>
                <th class="hidden px-6 py-3 sm:table-cell">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($workers as $worker)
                <tr class="border-t border-gray-200 dark:border-gray-700">
                    <td class="block px-6 py-4 sm:table-cell">
                        <span class="font-bold sm:hidden">Nombre:</span> {{ $worker->full_name ?? null }}
                    </td>
                    <td class="block px-6 py-4 sm:table-cell">
                        <span class="font-bold sm:hidden">Cédula:</span> {{ $worker->identification }}
                    </td>
                    <td class="block px-6 py-4 sm:table-cell">
                        <span class="font-bold sm:hidden">Área/Roll:</span>
                        <div class="truncate">{{ $worker->last_position_name }}</div>
                        <div class="text-sm truncate">{{ $worker->last_position_range }}</div>
                    </td>
                    <td class="block px-6 py-4 sm:table-cell">
                        <span class="font-bold sm:hidden">Salario:</span>
                        {{ number_format($worker->base_salary, 2, ',', '.') }}
                    </td>
                    <td class="block px-6 py-4 sm:table-cell">
                        <span class="font-bold sm:hidden">Estado:</span>
                        <span
                            class="px-2 py-1 rounded-full text-xs {{ $worker->is_active ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                            {{ $worker->is_active ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>
                    <td class="flex px-6 py-4 space-x-2 sm:table-cell md:block">

                        <span class="font-bold sm:hidden">Acciones:</span>
                        <div class="flex flex-row rounded-md shadow-sm" role="group">
                            <x-wireui-mini-button warning icon="pencil"
                                class="rounded-t-md sm:rounded-l-md sm:rounded-tr-none sm:rounded-br-none"
                                wire:click="edit({{ $worker->id }})"
                                wire:loading.attr="disabled"
                                wire:target="edit({{ $worker->id }})" />
                            <x-wireui-mini-button negative icon="trash"
                                class="sm:rounded-none"
                                :disabled="$worker->is_active"
                                wire:click="confirmDelete({{ $worker->id }})"
                                wire:loading.attr="disabled"
                                wire:target="confirmDelete({{ $worker->id }})" />
                            <x-wireui-mini-button positive icon="newspaper"
                                class="rounded-b-md sm:rounded-r-md sm:rounded-tl-none sm:rounded-bl-none"
                                wire:click="setModePosition({{ $worker->id }})"
                                wire:loading.attr="disabled"
                                wire:target="setModePosition({{ $worker->id }})" />
                        </div>

                    </td>
                </tr>
            @endforeach

            @if ($workers->count() === 0)
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                        No se encontraron trabajadores
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
