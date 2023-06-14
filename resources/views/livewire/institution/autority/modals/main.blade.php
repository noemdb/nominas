<x-modal wire:model.defer="showModal">
    <x-card title="Autoridad">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            Nuevo registro
        </h3>

        @include('livewire.institution.autority.form.create')

        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">
                <x-button flat label="Calcelar" x-on:click="close" />
                <x-button primary label="Guardar" wire:click="save" />
            </div>
        </x-slot>
    </x-card>
</x-modal>
