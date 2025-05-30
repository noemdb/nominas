<div class="p-4 mb-6 rounded-lg bg-gray-50">
    <h3 class="mb-4 text-lg font-semibold">{{ $editingScheduleId ? 'Editar Horario' : 'Nuevo Horario' }}</h3>

    <form wire:submit="{{ $editingScheduleId ? 'update' : 'create' }}" class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
        <div>
            <label class="block text-sm font-medium text-gray-700">Cargo</label>
            <select wire:model="position_id" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                <option value="">Seleccione un cargo</option>
                @foreach($positions as $position)
                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                @endforeach
            </select>
            @error('position_id') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Día de la Semana</label>
            <select wire:model="day_of_week" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                <option value="">Seleccione un día</option>
                @foreach($daysOfWeek as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
            @error('day_of_week') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Horas Planificadas</label>
            <input type="number" wire:model="planned_hours" step="0.5" min="0" max="24"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
            @error('planned_hours') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700">Observaciones</label>
            <textarea wire:model="observations" rows="2"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
            @error('observations') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center">
            <label class="inline-flex items-center">
                <input type="checkbox" wire:model="is_active" class="form-checkbox">
                <span class="ml-2">Activo</span>
            </label>
        </div>

        <div class="flex items-center space-x-4">
            <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                {{ $editingScheduleId ? 'Actualizar' : 'Crear' }}
            </button>
            @if($editingScheduleId)
                <button type="button" wire:click="resetForm" class="px-4 py-2 text-white bg-gray-500 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                    Cancelar
                </button>
            @endif
        </div>
    </form>

    @if($position_id)
        <div class="grid grid-cols-2 gap-4 mt-4 text-sm">
            <div class="p-3 rounded-lg bg-blue-50">
                <span class="font-medium">Horas Semanales:</span> {{ number_format($weeklyHours, 2) }} horas
            </div>
            <div class="p-3 rounded-lg bg-green-50">
                <span class="font-medium">Horas Mensuales Estimadas:</span> {{ number_format($monthlyHours, 2) }} horas
            </div>
        </div>
    @endif
</div>

<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Cargo</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Día</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Horas</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Estado</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($schedules as $schedule)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $schedule->position->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $schedule->getDayNameInSpanish() }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ number_format($schedule->planned_hours, 2) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $schedule->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $schedule->is_active ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                        <button wire:click="edit({{ $schedule->id }})" class="mr-3 text-blue-600 hover:text-blue-900">Editar</button>
                        <button wire:click="confirmDelete({{ $schedule->id }})" class="text-red-600 hover:text-red-900">Eliminar</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        No se encontraron horarios registrados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $schedules->links() }}
</div>
