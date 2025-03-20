<!-- Tabla de Listado -->
<table class="w-full mt-4 border-collapse bg-white dark:bg-gray-800">
    <thead class="bg-gray-200 dark:bg-gray-700">
        <tr>
            <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">ID</th>
            <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Trabajador</th>
            <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Área</th>
            <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Rol</th>
            <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Rango</th>
            <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Fin</th>
            <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Activo</th>
            <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Acciones</th>
        </tr>
    </thead>
    <tbody class="text-gray-700 dark:text-gray-300">
        @forelse ($positions as $position)
            <tr class="border-b border-gray-200 dark:border-gray-700 {{ (! $position->isCurrent()) ? 'text-gray-500' : null}}">
                <td class="px-4 py-2">{{ $position->id }}</td>
                <td class="px-4 py-2">{{ $position->worker->fullname }}</td>
                <td class="px-4 py-2">{{ $position->area->name }}</td>
                <td class="px-4 py-2">{{ $position->rol->name }}</td>
                <td class="px-4 py-2">
                    <div>
                        {{ $position->start_date }} - {{ $position->end_date }}
                    </div>
                </td>
                <td class="px-4 py-2"></td>
                <td class="px-4 py-2">
                    <span
                        class="px-2 py-1 rounded-full text-xs {{ $position->is_active ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                        {{ $position->is_active ? 'Activo' : 'Inactivo' }}
                    </span>
                </td>
                <td class="px-4 py-2">
                    <x-wireui-mini-button warning icon="pencil" wire:click="editPosition({{ $position->id }})" />
                    <x-wireui-mini-button negative icon="trash" :disabled="!$position->is_active" wire:click="deletePosition({{ $position->id }})" />
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="px-4 py-2 text-center text-gray-700 dark:text-gray-300">No hay cargos
                    registrados.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<!-- Paginación -->
<div class="mt-4">
    {{ $positions->links() }}
</div>
