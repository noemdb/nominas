<x-tabs :tabs="[
    'personal' => 'Personal',
    'contacto' => 'Contacto',
    'laboral' => 'Laboral',
    'financiera' => 'Financiera',
    'user' => 'Usuario'
]" :active-tab="'contacto'" storage-key="worker-form-tab">


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
        <div class="flex justify-end mt-8 space-x-3">
            <x-wireui-button white label="Cancelar" wire:click="closeModal" onclick="event.preventDefault();"/>
            <x-wireui-button type="submit" :label="$isEdit ? 'Actualizar' : 'Registrar'" />
        </div>
    </form>
</x-tabs>
