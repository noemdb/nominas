<x-modal wire:model.defer="showModal">

    <x-card title="Formaciones y capacitaciones.">

        <p class="text-gray-600">
            @if ($modeCreate) @include('livewire.employee.training.form.create') @endif
            @if ($modeEdit) @include('livewire.employee.training.form.edit') @endif
            @if ($modeShow) @include('livewire.employee.training.show.info') @endif
        </p>

        @if ($modeCreate || $modeEdit)
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Calcelar" x-on:click="close" />
                    <x-button primary label="Guardar" wire:click="save" spinner="save"/>
                </div>
            </x-slot>
        @endif

    </x-card>

</x-modal>
