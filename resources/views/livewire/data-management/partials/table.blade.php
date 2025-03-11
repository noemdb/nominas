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
                Cargo
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
                <td class="px-6 py-4">{{ $worker->first_name ?? null}}</td>
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
                    <button wire:click="edit({{ $worker->id }})"
                        class="text-blue-500 hover:text-blue-700">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </button>
                    <button wire:click="confirmDelete({{ $worker->id }})"
                        class="text-red-500 hover:text-red-700">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
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