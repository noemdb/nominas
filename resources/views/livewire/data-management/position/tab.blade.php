<div class="flex flex-col md:flex-row dark:bg-gray-900">
    <!-- Lista Vertical de Pestañas -->
    <div class="w-full md:w-1/4 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700">
        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse ($positions as $index => $position)
                <li wire:key="position-{{ $position->id }}" class="px-4 py-3 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700 {{ $activePosition && $activePosition->id === $position->id ? 'bg-gray-100 dark:bg-gray-700' : '' }}" wire:click="setActivePosition({{ $position->id }})">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-200">{{$loop->iteration}}. {{ $position->full_name }}</span>
                </li>
            @empty
                <li class="px-4 py-3 text-center text-gray-700 dark:text-gray-300">No hay cargos registrados.</li>
            @endforelse
        </ul>
    </div>

    <!-- Contenido de la Pestaña Seleccionada -->
    <div class="w-full md:w-3/4 p-2 bg-white rounded-sm {{ $activePosition ? 'bg-gray-100 dark:bg-gray-700' : 'dark:bg-gray-800' }}">
        @if ($activePosition)
            <div class="space-y-2">                

                <div class="grid grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                            Área: <span class="text-gray-700 dark:text-gray-300">{{ $activePosition->area->name }}</span>
                        </label>                        
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                            Rol: <span class="text-gray-700 dark:text-gray-300">{{ $activePosition->rol->name }}</span>
                        </label>                        
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                            Fecha de Inicio: <span class="text-gray-700 dark:text-gray-300">{{ $activePosition->start_date }}</span>
                        </label>                        
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                            Fecha de Fin: <span class="text-gray-700 dark:text-gray-300">{{ $activePosition->end_date }}</span>
                        </label>                        
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                            Activo: <span class="text-gray-700 dark:text-gray-300">{{ $activePosition->is_active ? 'Sí' : 'No' }}</span>
                        </label>                        
                    </div>
                </div>
            </div>

            <div class="flex justify-end items-end">
                <div>
                    @php $worker = $position->worker; @endphp
                    <x-wireui-mini-button warning icon="pencil" wire:click="editPosition({{ $activePosition->id }})"  />
                    <x-wireui-mini-button negative icon="trash" :disabled="$worker->is_active" wire:click="deletePosition({{ $activePosition->id }})" />
                </div>
            </div>

        @else
            <div class="text-center text-gray-700 dark:text-gray-300">
                <p>Selecciona un cargo de la lista para ver su información.</p>
            </div>
        @endif
    </div>
</div>

<!-- Paginación -->
<div class="mt-4">
    {{ $positions->links() }}
</div>