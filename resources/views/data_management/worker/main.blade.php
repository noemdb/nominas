<div class="max-w-7xl mx-auto p-6 lg:p-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
            Gestión de Trabajadores
        </h1>
        <a href="{{ route('workers.create') }}"
            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition">
            Registrar Trabajador
        </a>
    </div>

    <!-- Tabla de trabajadores -->
    <div class="bg-white dark:bg-gray-900 shadow-sm rounded-lg overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th class="px-6 py-3 text-gray-600 dark:text-gray-400">Nombre</th>
                    <th class="px-6 py-3">Cédula</th>
                    <th class="px-6 py-3">Cargo</th>
                    <th class="px-6 py-3">Salario</th>
                    <th class="px-6 py-3">Estado</th>
                    <th class="px-6 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($workers as $worker)
                    <tr class="border-t border-gray-200 dark:border-gray-700">
                        <td class="px-6 py-4">{{ $worker->fullname ?? null}}</td>
                        <td class="px-6 py-4">{{ $worker->identification }}</td>
                        <td class="px-6 py-4 {{ (! $worker->status_positions) ? 'text-gray-400' : null}}">{{ $worker->current_position_info}}</td>
                        <td class="px-6 py-4">{{ number_format($worker->base_salary, 2, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            <span
                                class="px-2 py-1 rounded-full text-xs {{ $worker->is_active ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                {{ $worker->is_active ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 space-x-2">
                            <a href="{{ route('workers.edit', $worker) }}"
                                class="text-blue-500 hover:text-blue-700">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </a>
                            <button onclick="confirmDelete({{ $worker->id }})"
                                class="text-red-500 hover:text-red-700">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="mt-6">
        {{ $workers->links() }}
    </div>
</div>
