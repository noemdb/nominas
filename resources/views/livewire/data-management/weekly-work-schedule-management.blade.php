<div>
    <div class="flex flex-col items-center justify-between mb-6 space-y-4 sm:flex-row sm:space-y-0">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
            Gestión de Horarios Semanales
        </h1>
        <x-wireui-button icon="plus" label="Nuevo Horario" wire:click="create" />
    </div>

    <!-- Search and Filter Section -->
    <div class="grid grid-cols-1 gap-4 mb-6 md:grid-cols-3">
        <div>
            <input wire:model.live="search" type="text" placeholder="Buscar por cargo..."
                class="w-full px-4 py-2 text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <x-wireui-select
                wire:model.live="selectedPosition"
                placeholder="Todos los cargos"
                :options="collect($positionOptions)->prepend(['value' => '', 'label' => 'Todos los cargos', 'description' => 'Mostrar horarios de todos los cargos'])"
                option-value="value"
                option-label="label"
                option-description="description"
            />
        </div>
        <div class="flex items-center">
            <label class="inline-flex items-center">
                <input wire:model.live="filterActive" type="checkbox" class="form-checkbox dark:bg-gray-800 dark:border-gray-600">
                <span class="ml-2 text-gray-700 dark:text-gray-300">Mostrar solo activos</span>
            </label>
        </div>
    </div>

   <!-- Table Section -->
<div class="overflow-x-auto">
    <div class="inline-block min-w-full align-middle">
        <div class="overflow-hidden bg-white rounded-lg shadow-sm dark:bg-gray-800">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Cargo</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Día</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Horas</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Estado</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                    @forelse($schedules as $schedule)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-gray-300">
                                {{ collect($positionOptions)->firstWhere('value', $schedule->position_id)['label'] ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-gray-300">
                                {{ $schedule->getDayNameInSpanish() }}
                            </td>
                            <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-gray-300">
                                {{ number_format($schedule->planned_hours, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $schedule->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                    {{ $schedule->is_active ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                <x-wireui-button icon="pencil" wire:click="edit({{ $schedule->id }})" flat />
                                <x-wireui-button icon="trash" wire:click="confirmDelete({{ $schedule->id }})" flat negative />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                No se encontraron horarios registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Pagination -->
<div class="mt-6">
    {{ $schedules->links() }}
</div>



    <!-- Form Modal -->
    @if($showModal)
        @include('livewire.data-management.modal.actionWeeklySchedule')
    @endif

    <!-- Delete Modal -->
    @if($showDeleteModal)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-75">
            <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-xl dark:bg-gray-800">
                <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-gray-200">Confirmar Eliminación</h3>
                <p class="mb-4 text-gray-500 dark:text-gray-400">¿Está seguro que desea eliminar este horario? Esta acción no se puede deshacer.</p>
                <div class="flex justify-end space-x-4">
                    <x-wireui-button white label="Cancelar" wire:click="$set('showDeleteModal', false)" flat />
                    <x-wireui-button icon="trash" label="Eliminar" wire:click="delete" negative />
                </div>
            </div>
        </div>
    @endif

    <!-- Flash Messages -->
    <div x-data="{ show: false, message: '' }"
         x-on:schedule-created.window="show = true; message = $event.detail; setTimeout(() => show = false, 3000)"
         x-on:schedule-updated.window="show = true; message = $event.detail; setTimeout(() => show = false, 3000)"
         x-on:schedule-deleted.window="show = true; message = $event.detail; setTimeout(() => show = false, 3000)"
         x-show="show"
         x-transition
         class="fixed px-6 py-3 text-white bg-green-500 rounded-lg shadow-lg dark:bg-green-600 bottom-4 right-4">
        <span x-text="message"></span>
    </div>

    <livewire:loading-indicator />
</div>
