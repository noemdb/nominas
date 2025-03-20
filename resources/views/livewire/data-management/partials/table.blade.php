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
                <td class="px-6 py-4 {{ (! $worker->status_positions) ? 'text-gray-400' : null}}">{{ $worker->last_position_info}}</td>
                <td class="px-6 py-4">{{ number_format($worker->base_salary, 2, ',', '.') }}</td>
                <td class="px-6 py-4">
                    <span
                        class="px-2 py-1 rounded-full text-xs {{ $worker->is_active ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                        {{ $worker->is_active ? 'Activo' : 'Inactivo' }}
                    </span>
                </td>
                <td class="px-6 py-4 space-x-2 flex">
                    <x-wireui-mini-button warning icon="pencil" wire:click="edit({{ $worker->id }})" />
                    <x-wireui-mini-button negative icon="trash" :disabled="$worker->is_active" wire:click="confirmDelete({{ $worker->id }})" />
                    <x-wireui-mini-button positive icon="user" wire:click="setModePosition({{ $worker->id }})" />

                    @if($showModalPosition && $workerId === $worker->id)
                        <!-- Modal para crear/editar posiciones -->
                        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4" wire:key="modal-{{ $isEdit ? 'edit-'.$workerId : 'create' }}">
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-fit flex flex-col">
                                <!-- Encabezado del modal -->
                                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                                    <div class="flex justify-between items-center">
                                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                            {{ $isEdit ? 'Posiciones del Trabajador' : 'Registrar una Nueva Posicion' }}
                                        </h3>
                                        <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500">
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Contenido del modal con scroll -->
                                <div class="overflow-y-auto p-4 flex-grow">
                                    <livewire:data-management.positions-manager worker_id="{{$isEdit ? $workerId : null}}" :key="$isEdit ? 'mode-positions-edit'.$workerId : 'mode-positions-create'"/> 
                                </div>
                                
                            </div>
                        </div>                        
                    @endif
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