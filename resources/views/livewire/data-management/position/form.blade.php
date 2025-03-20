<div class="flex items-center justify-center dark:border-gray-700 mb-6">
    <div class="w-full p-6 bg-white rounded shadow-lg dark:bg-gray-800 dark:text-gray-200">
        <h2 class="mb-4 text-xl font-bold dark:text-gray-100">{{ $isEditPosition ? 'Editar' : 'Crear' }} Cargo</h2>

        <!-- Contenedor con scroll vertical -->
        <div class="max-h-[70vh] overflow-y-auto">
            <form wire:submit.prevent="storePosition">
                <div class="mb-4">
                    <label class="block mb-2 dark:text-gray-300">Fecha de Inicio:</label>
                    <input type="date" wire:model="start_date"
                        class="w-full px-3 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                    @error('start_date')
                        <span class="text-red-500 dark:text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-2 dark:text-gray-300">Fecha de Fin:</label>
                    <input type="date" wire:model="end_date"
                        class="w-full px-3 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                    @error('end_date')
                        <span class="text-red-500 dark:text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-2 dark:text-gray-300">Observaciones:</label>
                    <textarea wire:model="observations"
                        class="w-full px-3 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"></textarea>
                    @error('observations')
                        <span class="text-red-500 dark:text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-2 dark:text-gray-300">Activo:</label>
                    <input type="checkbox" wire:model="is_active" class="dark:bg-gray-700 dark:border-gray-600">
                    @error('is_active')
                        <span class="text-red-500 dark:text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-2 dark:text-gray-300">Área:</label>
                    <select wire:model="area_id"
                        class="w-full px-3 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                        <option value="">Selecciona un área</option>
                        @foreach ($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                        @endforeach
                    </select>
                    @error('area_id')
                        <span class="text-red-500 dark:text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-2 dark:text-gray-300">Rol:</label>
                    <select wire:model="rol_id"
                        class="w-full px-3 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                        <option value="">Selecciona un rol</option>
                        @foreach ($rols as $rol)
                            <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                        @endforeach
                    </select>
                    @error('rol_id')
                        <span class="text-red-500 dark:text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-2 dark:text-gray-300">Trabajador:</label>
                    <select wire:model="worker_id"
                        class="w-full px-3 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                        <option value="">Selecciona un trabajador</option>
                        @foreach ($workers as $worker)
                            <option value="{{ $worker->id }}"
                                {{ $selected_worker_id == $worker->id ? 'selected' : '' }}>
                                {{ $worker->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('worker_id')
                        <span class="text-red-500 dark:text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Botones -->
                <div class="mt-8 flex justify-end space-x-3">
                    <x-wireui-button white label="Cancelar" wire:click="closePosition" onclick="event.preventDefault();"
                        class="dark:bg-gray-700 dark:text-gray-200" />
                    <x-wireui-button type="submit" :label="$isEditPosition ? 'Actualizar' : 'Registrar'" class="dark:bg-gray-700 dark:text-gray-200" />
                </div>
            </form>
        </div>
    </div>
</div>
