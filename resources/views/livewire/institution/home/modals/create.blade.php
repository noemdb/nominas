{{-- <button wire:click="$toggle('showModal')">Nuevo Registro</button> --}}

<x-button.circle wire:click="$toggle('showModal')" primary label="+" />


<x-modal wire:model.defer="showModal">
    <x-card title="Nueva Institución">

        <p class="text-gray-600">
            @include('livewire.institution.home.form.create')
        </p>

        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">
                <x-button flat label="Calcelar" x-on:click="close" />
                <x-button primary label="Guardar" wire:click="save" />
            </div>
        </x-slot>

    </x-card>
</x-modal>
