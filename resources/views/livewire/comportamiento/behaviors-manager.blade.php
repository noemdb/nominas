<div class="p-6 mx-auto lg:p-8">
    <div class="flex flex-col items-center justify-between mb-6 space-y-4 sm:flex-row sm:space-y-0">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
            Gestión de Comportamiento Laboral
        </h1>
        <x-wireui-button icon="plus" label="Registrar Comportamiento" wire:click="create" />
    </div>

    <!-- Filtros y búsqueda -->
    <div class="flex items-center justify-between mb-4">
        <div class="w-1/3">
            <div class="relative w-full">

                <x-wireui-input
                    icon="magnifying-glass"
                    wire:model.live.debounce.300ms="search"
                    label="Filtrar"
                    placeholder="Buscar por trabajador, fecha..."
                    description="Ingresa el texto para filtrar el listado"
                />

                <!-- Botón para limpiar el input -->
                @if ($search)
                    <button
                        type="button"
                        wire:click="clearSearch"
                        class="absolute text-gray-500 transform -translate-y-1/2 right-2 top-1/2 hover:text-gray-700 dark:hover:text-gray-400"
                    >
                        &times;
                    </button>
                @endif
            </div>
        </div>
        <div class="flex items-center space-x-2">
            <select wire:model.live="perPage" class="px-4 py-2 border rounded-md dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300">
                <option value="10">10 por página</option>
                <option value="25">25 por página</option>
                <option value="50">50 por página</option>
                <option value="100">100 por página</option>
            </select>
        </div>
    </div>

    <!-- Tabla de comportamientos -->
    <div class="overflow-hidden bg-white rounded-lg shadow-sm dark:bg-gray-900">
        @if (!$isLoaded)
            {{-- <x-skeleton.table :rows="5" /> --}}
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th wire:click="sortBy('date')" class="hidden px-6 py-3 text-gray-600 cursor-pointer dark:text-gray-400 sm:table-cell">
                                <div class="flex items-center space-x-1">
                                    <span>Fecha</span>
                                    @if ($sortField === 'date')
                                        <span>{!! $sortDirection === 'asc' ? '&#8593;' : '&#8595;' !!}</span>
                                    @endif
                                </div>
                            </th>
                            <th class="hidden px-6 py-3 sm:table-cell">Trabajador</th>
                            <th class="hidden px-6 py-3 sm:table-cell">Asistencia</th>
                            <th class="hidden px-6 py-3 sm:table-cell">Faltas</th>
                            <th class="hidden px-6 py-3 sm:table-cell">Permisos</th>
                            <th class="hidden px-6 py-3 sm:table-cell">Retardos</th>
                            {{-- <th class="hidden px-6 py-3 sm:table-cell">Bono/Descuento</th> --}}
                            <th wire:click="sortBy('status')" class="hidden px-6 py-3 cursor-pointer sm:table-cell">
                                <div class="flex items-center space-x-1">
                                    <span>Estado</span>
                                    @if ($sortField === 'status')
                                        <span>{!! $sortDirection === 'asc' ? '&#8593;' : '&#8595;' !!}</span>
                                    @endif
                                </div>
                            </th>
                            <th class="hidden px-6 py-3 sm:table-cell">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($behaviors as $behavior)
                            <tr class="border-t border-gray-200 dark:border-gray-700">
                                <td class="block px-6 py-4 sm:table-cell">
                                    <span class="font-bold sm:hidden">Fecha:</span>
                                    <span>{{ $behavior->date->format('d/m/Y') }}</span>
                                </td>
                                <td class="block px-6 py-4 sm:table-cell">
                                    <span class="font-bold sm:hidden">Trabajador:</span>
                                    <span>{{ $behavior->worker->full_name }}</span>
                                </td>
                                <td class="block px-6 py-4 sm:table-cell">
                                    <span class="font-bold sm:hidden">Asistencia:</span>
                                    <span>{{ $behavior->attendance_days }} días</span>
                                </td>
                                <td class="block px-6 py-4 sm:table-cell">
                                    <span class="font-bold sm:hidden">Faltas:</span>
                                    <span>{{ $behavior->absences }}</span>
                                </td>
                                <td class="block px-6 py-4 sm:table-cell">
                                    <span class="font-bold sm:hidden">Permisos:</span>
                                    <span>{{ $behavior->permissions }}</span>
                                </td>
                                <td class="block px-6 py-4 sm:table-cell">
                                    <span class="font-bold sm:hidden">Retardos:</span>
                                    <span>{{ $behavior->delays }}</span>
                                </td>
                                {{-- <td class="block px-6 py-4 sm:table-cell">
                                    <span class="font-bold sm:hidden">Bono/Descuento:</span>
                                    <div>
                                        @if($behavior->bonus > 0)
                                            <span class="text-green-600">+{{ number_format($behavior->bonus, 2) }}</span>
                                        @endif
                                        @if($behavior->discount > 0)
                                            <span class="text-red-600">-{{ number_format($behavior->discount, 2) }}</span>
                                        @endif
                                    </div>
                                </td> --}}
                                <td class="block px-6 py-4 sm:table-cell">
                                    <span class="font-bold sm:hidden">Estado:</span>
                                    <span class="px-2 py-1 rounded-full text-xs
                                        @if($behavior->status === 'approved') bg-green-200 text-green-800
                                        @elseif($behavior->status === 'rejected') bg-red-200 text-red-800
                                        @else bg-yellow-200 text-yellow-800
                                        @endif">
                                        {{ ucfirst($behavior->status) }}
                                    </span>
                                </td>
                                <td class="flex px-6 py-4 space-x-2 sm:table-cell">
                                    <span class="font-bold sm:hidden">Acciones:</span>
                                    <div class="flex flex-row rounded-md shadow-sm" role="group">
                                        <x-wireui-mini-button
                                            warning
                                            icon="pencil"
                                            class="rounded-t-md sm:rounded-l-md sm:rounded-tr-none sm:rounded-br-none"
                                            wire:click="edit({{ $behavior->id }})"
                                            wire:loading.attr="disabled"
                                            wire:target="edit({{ $behavior->id }})"
                                            x-tooltip.raw="Editar comportamiento" />
                                        <x-wireui-mini-button
                                            negative
                                            icon="trash"
                                            class="rounded-b-md sm:rounded-r-md sm:rounded-tl-none sm:rounded-bl-none"
                                            wire:click="confirmDelete({{ $behavior->id }})"
                                            wire:loading.attr="disabled"
                                            wire:target="confirmDelete({{ $behavior->id }})"
                                            x-tooltip.raw="Eliminar comportamiento" />
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @if ($behaviors->count() === 0)
                            <tr>
                                <td colspan="9" class="px-6 py-4 text-center text-gray-500">
                                    No se encontraron registros de comportamiento
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Paginación -->
    <div class="mt-6">
        {{ $behaviors->links() }}
    </div>

    <!-- Modal para crear/editar comportamiento -->
    @includeWhen($showModal, 'livewire.comportamiento.modal.action-behavior')

    <!-- Modal de confirmación de eliminación -->
    @includeWhen($confirmingDelete, 'livewire.comportamiento.modal.confirming-delete')

    <!-- Loading inicial del componente -->
    <div wire:init="setLoaded" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-75"
        x-data="{ show: true }" x-show="show" x-init="$wire.$on('component-loaded', () => { setTimeout(() => { show = false }, 300) })">
        <div class="flex flex-col items-center justify-center space-y-3 text-white">
            <svg class="w-12 h-12 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                    stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
            </svg>
            <p class="text-lg font-semibold">Cargando componente...</p>
        </div>
    </div>

</div>
