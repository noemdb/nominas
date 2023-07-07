<x-modal wire:model.defer="showModal">

    <x-card title="Formulación">

        @if ($modeCreate)
            @include('livewire.formulation.home.form.create')
        @endif
        @if ($modeEdit)
            @include('livewire.formulation.home.form.edit')
        @endif
        @if ($modeShow)
            @include('livewire.formulation.home.show.info')
        @endif

        @if ($modeCreate || $modeEdit)
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Calcelar" x-on:click="close" />
                    <x-button primary label="Guardar" wire:click="save" spinner="save" />
                </div>
            </x-slot>
        @endif

    </x-card>

</x-modal>
