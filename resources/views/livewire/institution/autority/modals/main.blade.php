<x-modal wire:model.defer="showModal">
    <x-card title="Autoridad">
        @include('livewire.institution.autority.form.create')

        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">
                <x-button flat label="Calcelar" x-on:click="close" />
                <x-button primary label="Guardar" wire:click="save" />
            </div>
        </x-slot>
    </x-card>
</x-modal>
