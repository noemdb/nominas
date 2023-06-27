<x-modal wire:model.defer="showModal">

    <x-card title="Información Personal">

        <p class="text-gray-600">
            @if ($modeCreate) @include('livewire.employee.personal.form.create') @endif
            @if ($modeEdit) @include('livewire.employee.personal.form.edit') @endif
            @if ($modeShow) @include('livewire.employee.personal.show.info') @endif
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
