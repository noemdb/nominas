<x-modal wire:model.defer="showModal">
    <x-card title="Área">
        @if ($modeCreate)
            @include('livewire.institution.area.form.create')
        @endif
        @if ($modeEdit)
            @include('livewire.institution.area.form.edit')
        @endif
        @if ($modeShow)
            @include('livewire.institution.area.show.info')
        @endif

        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">
                <x-button flat label="Calcelar" x-on:click="close" />
                <x-button primary label="Guardar" wire:click="save" />
            </div>
        </x-slot>
    </x-card>
</x-modal>
