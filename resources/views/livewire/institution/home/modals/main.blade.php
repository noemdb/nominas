<x-modal wire:model.defer="showModal">
    <x-card title="Institución">

        <p class="text-gray-600">
            @if ($institution)
                @include('livewire.institution.home.form.create')
            @else
                @include('livewire.institution.home.form.edit')
            @endif
        </p>

        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">
                <x-button flat label="Calcelar" x-on:click="close" />
                <x-button primary label="Guardar" wire:click="save" />
            </div>
        </x-slot>

    </x-card>
</x-modal>
