
@if (! $isEditPosition)
    <div class="mb-4">
        <label class="block mb-2 dark:text-gray-300">Trabajador:</label>
        <select wire:model="worker_id"
            class="w-full px-3 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
            <option value="">Selecciona un trabajador</option>
            @foreach ($workers as $worker)
                <option value="{{ $worker->id }}">
                    {{ $worker->fullname }}
                </option>
            @endforeach
        </select>
        @error('worker_id')
            <span class="text-red-500 dark:text-red-400">{{ $message }}</span>
        @enderror
    </div>
@endif

<div x-data="{ tab: localStorage.getItem('activeTabPosition') || 'range' }"
    x-init="$watch('tab', value => localStorage.setItem('activeTabPosition', value))"  x-cloak>

    <!-- Navegación de Pestañas -->
    <div class="flex space-x-4 border-b border-gray-200 dark:border-gray-700 mb-6">        
        <button @click="tab = 'range'"
            :class="tab === 'range' ? 'border-b-2 border-blue-500 text-blue-500 font-semibold' : 'text-gray-600'"
            class="px-4 py-2 focus:outline-none transition">
            Rango
        </button>  
        <button @click="tab = 'rol'"
            :class="tab === 'rol' ? 'border-b-2 border-blue-500 text-blue-500 font-semibold' : 'text-gray-600'"
            class="px-4 py-2 focus:outline-none transition">
            Rol
        </button>      
        <button @click="tab = 'details'"
            :class="tab === 'details' ? 'border-b-2 border-blue-500 text-blue-500 font-semibold' : 'text-gray-600'"
            class="px-4 py-2 focus:outline-none transition">
            Detalles
        </button>
    </div>

    <form wire:submit.prevent="storePosition" class="space-y-6">
        <!-- Información range -->
        <template x-if="tab === 'range'">
            <div>
                

                <div class="grid grid-cols-2 gap-4">
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
                </div>  

            </div>
        </template>

        <!-- Información de rol -->
        <template x-if="tab === 'rol'">
            <div>
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
            </div>
        </template>

        <!-- Información details -->
        <template x-if="tab === 'details'">
            <div>
                <div class="mb-4">
                    <label class="block mb-2 dark:text-gray-300">Observaciones:</label>
                    <textarea wire:model="observations"
                        class="w-full px-3 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"></textarea>
                    @error('observations')
                        <span class="text-red-500 dark:text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    {{-- <label class="block mb-2 dark:text-gray-300">Activo:</label>
                    <input type="checkbox" wire:model="is_active" class="dark:bg-gray-700 dark:border-gray-600">
                    @error('is_active')
                        <span class="text-red-500 dark:text-red-400">{{ $message }}</span>
                    @enderror --}}

                    <x-wireui-checkbox id="right-label" label="Activo" wire:model="is_active" />
                </div>
            </div>
        </template>

        <x-wireui-errors />

        <!-- Botones -->
        <div class="mt-8 flex justify-end space-x-3">
            <x-wireui-button white label="Cancelar" wire:click="closePosition" onclick="event.preventDefault();"
                class="dark:bg-gray-700 dark:text-gray-200" />
            <x-wireui-button type="submit" :label="$isEditPosition ? 'Actualizar' : 'Registrar'" class="dark:bg-gray-700 dark:text-gray-200" />
        </div>

    </form>
</div>
