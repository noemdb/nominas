<table class="w-full text-left">
    <thead class="bg-gray-50 dark:bg-gray-800">
        <tr>
            <th wire:click="sortBy('first_name')" class="px-6 py-3 text-gray-600 dark:text-gray-400 cursor-pointer">
                Nombre
                @if ($sortField === 'first_name')
                    <span>{!! $sortDirection === 'asc' ? '&#8593;' : '&#8595;' !!}</span>
                @endif
            </th>
            <th wire:click="sortBy('identification')" class="px-6 py-3 cursor-pointer">
                Cédula
                @if ($sortField === 'identification')
                    <span>{!! $sortDirection === 'asc' ? '&#8593;' : '&#8595;' !!}</span>
                @endif
            </th>
            <th wire:click="sortBy('current_position_info')" class="px-6 py-3 cursor-pointer">
                Área/Roll
                @if ($sortField === 'current_position_info')
                    <span>{!! $sortDirection === 'asc' ? '&#8593;' : '&#8595;' !!}</span>
                @endif
            </th>
            <th wire:click="sortBy('base_salary')" class="px-6 py-3 cursor-pointer">
                Salario
                @if ($sortField === 'base_salary')
                    <span>{!! $sortDirection === 'asc' ? '&#8593;' : '&#8595;' !!}</span>
                @endif
            </th>
            <th wire:click="sortBy('is_active')" class="px-6 py-3 cursor-pointer">
                Estado
                @if ($sortField === 'is_active')
                    <span>{!! $sortDirection === 'asc' ? '&#8593;' : '&#8595;' !!}</span>
                @endif
            </th>
            <th class="px-6 py-3">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($workers as $worker)
            <tr class="border-t border-gray-200 dark:border-gray-700">
                <td class="px-6 py-4">{{ $worker->full_name ?? null}}</td>
                <td class="px-6 py-4">{{ $worker->identification }}</td>
                <td class="px-6 py-4 {{ (! $worker->status_positions) ? 'text-gray-400' : null}}">{{ $worker->current_position_info}}</td>
                <td class="px-6 py-4">{{ number_format($worker->base_salary, 2, ',', '.') }}</td>
                <td class="px-6 py-4">
                    <span
                        class="px-2 py-1 rounded-full text-xs {{ $worker->is_active ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                        {{ $worker->is_active ? 'Activo' : 'Inactivo' }}
                    </span>
                </td>
                <td class="px-6 py-4 space-x-2 flex">
                    <x-wireui-mini-button warning flat icon="pencil" wire:click="edit({{ $worker->id }})" />
                    <x-wireui-mini-button negative flat icon="trash" :disabled="$worker->is_active" wire:click="confirmDelete({{ $worker->id }})" />
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