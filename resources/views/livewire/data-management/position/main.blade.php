@if (! $isEditPosition)
    <div class="mb-4">
        <!-- Trabajador -->
        <x-wireui-select
            wire:model="worker_id"
            label="Trabajador"
            placeholder="Seleccione un trabajador"
            :options="$workerOptions"
            option-value="value"
            option-label="label"
        />
    </div>
@endif

<div x-data="{ tab: localStorage.getItem('activeTabPosition') || 'range' }"
    x-init="$watch('tab', value => localStorage.setItem('activeTabPosition', value))"  x-cloak>

    <!-- Navegación de Pestañas -->
    <div class="flex mb-6 space-x-4 border-b border-gray-200 dark:border-gray-700">
        <button @click="tab = 'range'"
            :class="tab === 'range' ? 'border-b-2 border-blue-500 text-blue-500 font-semibold' : 'text-gray-600'"
            class="px-4 py-2 transition focus:outline-none">
            Rango
        </button>
        <button @click="tab = 'rol'"
            :class="tab === 'rol' ? 'border-b-2 border-blue-500 text-blue-500 font-semibold' : 'text-gray-600'"
            class="px-4 py-2 transition focus:outline-none">
            Rol
        </button>
        <button @click="tab = 'details'"
            :class="tab === 'details' ? 'border-b-2 border-blue-500 text-blue-500 font-semibold' : 'text-gray-600'"
            class="px-4 py-2 transition focus:outline-none">
            Detalles
        </button>
    </div>

    <form wire:submit.prevent="storePosition" class="space-y-6">

        <!-- Información range -->
        <template x-if="tab === 'range'">
            <div>
                <div class="grid grid-cols-1 gap-4">
                    <div class="mb-4">
                        <x-wireui-input
                            type="date"
                            label="Fecha de Inicio"
                            wire:model="start_date"
                        />
                    </div>

                    {{--
                    Si oculta la fecha final
                    <div class="mb-4">
                        <x-wireui-input
                            type="date"
                            label="Fecha de Fin"
                            wire:model="end_date"
                        />
                    </div>
                    --}}
                </div>
            </div>
        </template>

        <!-- Información de rol -->
        <template x-if="tab === 'rol'">
            <div>
                <!-- Área -->
                <div class="mb-4">
                    <x-wireui-select
                        wire:model="area_id"
                        label="Área"
                        placeholder="Seleccione un área"
                        :options="$areaOptions"
                        option-value="value"
                        option-label="label"
                    />
                </div>
                <!-- Rol -->
                <div>
                    <x-wireui-select
                        wire:model="rol_id"
                        label="Rol"
                        placeholder="Seleccione un rol"
                        :options="$rolOptions"
                        option-value="value"
                        option-label="label"
                    />
                </div>
            </div>
        </template>

        <!-- Información details -->
        <template x-if="tab === 'details'">
            <div>
                <div class="mb-4">
                    <x-wireui-textarea
                        label="Observaciones"
                        wire:model="observations"
                        :error="$errors->has('observations')"
                        :helper="$errors->first('observations')"
                        rows="3"
                    />
                </div>

                <div class="mb-4">
                    <x-wireui-checkbox
                        label="Activo"
                        wire:model="is_active"
                        :error="$errors->has('is_active')"
                        :helper="$errors->first('is_active')"
                    />
                </div>
            </div>
        </template>

        <x-wireui-errors />

        <!-- Botones -->
        <div class="flex justify-end mt-8 space-x-3">
            <x-wireui-button
                white
                label="Cancelar"
                wire:click="closePosition"
                onclick="event.preventDefault();"
            />
            <x-wireui-button
                type="submit"
                :label="$isEditPosition ? 'Actualizar' : 'Registrar'"
                primary
            />
        </div>

    </form>
</div>
