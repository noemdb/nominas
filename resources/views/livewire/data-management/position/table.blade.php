<!-- Tabla de Listado -->
<table class="w-full mt-4 border-collapse bg-white dark:bg-gray-800">
    <thead class="bg-gray-200 dark:bg-gray-700">
        <tr>
            <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">ID</th>
            <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Trabajador</th>
            <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Área</th>
            <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Rol</th>
            <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Inicio</th>
            <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Fin</th>
            <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Activo</th>
            <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Acciones</th>
        </tr>
    </thead>
    <tbody class="text-gray-700 dark:text-gray-300">
        @forelse ($positions as $position)
            <tr class="border-b border-gray-200 dark:border-gray-700">
                <td class="px-4 py-2">{{ $position->id }}</td>
                <td class="px-4 py-2">{{ $position->worker->name }}</td>
                <td class="px-4 py-2">{{ $position->area->name }}</td>
                <td class="px-4 py-2">{{ $position->rol->name }}</td>
                <td class="px-4 py-2">{{ $position->start_date }}</td>
                <td class="px-4 py-2">{{ $position->end_date }}</td>
                <td class="px-4 py-2">{{ $position->is_active ? 'Sí' : 'No' }}</td>
                <td class="px-4 py-2">
                    <button wire:click="edit({{ $position->id }})"
                        class="px-2 py-1 text-white bg-yellow-500 rounded hover:bg-yellow-600 dark:bg-yellow-700 dark:hover:bg-yellow-800">
                        Editar
                    </button>
                    <button wire:click="delete({{ $position->id }})"
                        class="px-2 py-1 ml-2 text-white bg-red-500 rounded hover:bg-red-600 dark:bg-red-700 dark:hover:bg-red-800">
                        Eliminar
                    </button>
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
