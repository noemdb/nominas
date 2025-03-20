
<div x-data="{ tab: localStorage.getItem('activeTab') || 'contacto' }"
    x-init="$watch('tab', value => localStorage.setItem('activeTab', value))"  x-cloak>

    <!-- Navegación de Pestañas -->
    <div class="flex space-x-4 border-b border-gray-200 dark:border-gray-700 mb-6">        
        <button @click="tab = 'personal'"
            :class="tab === 'personal' ? 'border-b-2 border-blue-500 text-blue-500 font-semibold' : 'text-gray-600'"
            class="px-4 py-2 focus:outline-none transition">
            Personal
        </button>  
        <button @click="tab = 'contacto'"
            :class="tab === 'contacto' ? 'border-b-2 border-blue-500 text-blue-500 font-semibold' : 'text-gray-600'"
            class="px-4 py-2 focus:outline-none transition">
            Contacto
        </button>      
        <button @click="tab = 'laboral'"
            :class="tab === 'laboral' ? 'border-b-2 border-blue-500 text-blue-500 font-semibold' : 'text-gray-600'"
            class="px-4 py-2 focus:outline-none transition">
            Laboral
        </button>
        <button @click="tab = 'financiera'"
            :class="tab === 'financiera' ? 'border-b-2 border-blue-500 text-blue-500 font-semibold' : 'text-gray-600'"
            class="px-4 py-2 focus:outline-none transition">
            Financiera
        </button>

        <button @click="tab = 'user'"
            :class="tab === 'user' ? 'border-b-2 border-blue-500 text-blue-500 font-semibold' : 'text-gray-600'"
            class="px-4 py-2 focus:outline-none transition">
            Usuario
        </button>
    </div>

    <form wire:submit.prevent="save" class="space-y-6">
        <!-- Información Personal -->
        <template x-if="tab === 'personal'">
            <div>
                @include('livewire.data-management.partials.personal')
            </div>
        </template>

        <!-- Información de Contacto -->
        <template x-if="tab === 'contacto'">
            <div>
                @include('livewire.data-management.partials.contact')
            </div>
        </template>

        <!-- Información Laboral -->
        <template x-if="tab === 'laboral'">
            <div>
                @include('livewire.data-management.partials.laboral')
            </div>
        </template>

        <!-- Información Financiera -->
        <template x-if="tab === 'financiera'">
            <div>
                @include('livewire.data-management.partials.financiera')
            </div>
        </template>

        <!-- Información del Usuario -->
        <template x-if="tab === 'user'">
            <div>
                @include('livewire.data-management.partials.user')
            </div>
        </template>

        <x-wireui-errors />

        <!-- Botones -->
        <div class="mt-8 flex justify-end space-x-3">

            <x-wireui-button white label="Cancelar" wire:click="closeModal" onclick="event.preventDefault();"/>

            <x-wireui-button type="submit" :label="$isEdit ? 'Actualizar' : 'Registrar'" />

        </div>
    </form>
</div>
