    <!-- Modal para Crear/Editar -->
    @if ($isOpenPosition)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="w-full max-w-lg p-6 bg-white rounded shadow-lg">
                <h2 class="mb-4 text-xl font-bold">{{ $isEditPosition ? 'Editar' : 'Crear' }} Cargo</h2>

                <form wire:submit.prevent="storePosition">
                    <div class="mb-4">
                        <label class="block mb-2">Fecha de Inicio:</label>
                        <input type="date" wire:model="start_date" class="w-full px-3 py-2 border rounded">
                        @error('start_date') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Fecha de Fin:</label>
                        <input type="date" wire:model="end_date" class="w-full px-3 py-2 border rounded">
                        @error('end_date') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Observaciones:</label>
                        <textarea wire:model="observations" class="w-full px-3 py-2 border rounded"></textarea>
                        @error('observations') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Activo:</label>
                        <input type="checkbox" wire:model="is_active">
                        @error('is_active') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Área:</label>
                        <select wire:model="area_id" class="w-full px-3 py-2 border rounded">
                            <option value="">Selecciona un área</option>
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->name }}</option>
                            @endforeach
                        </select>
                        @error('area_id') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Rol:</label>
                        <select wire:model="rol_id" class="w-full px-3 py-2 border rounded">
                            <option value="">Selecciona un rol</option>
                            @foreach ($rols as $rol)
                                <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                            @endforeach
                        </select>
                        @error('rol_id') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Trabajador:</label>
                        <select wire:model="worker_id" class="w-full px-3 py-2 border rounded">
                            <option value="">Selecciona un trabajador</option>
                            @foreach ($workers as $worker)
                                <option value="{{ $worker->id }}" {{ $selected_worker_id == $worker->id ? 'selected' : '' }}>
                                    {{ $worker->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('worker_id') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 mr-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">
                            Cancelar
                        </button>
                        <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif