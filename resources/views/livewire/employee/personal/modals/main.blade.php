<x-modal wire:model.defer="showModal">

    <x-card title="Empleado">

        <p class="text-gray-600">
            @if ($modeCreate) @include('livewire.employee.home.form.create') @endif
            @if ($modeEdit) @include('livewire.employee.home.form.edit') @endif
            @if ($modeShow) @include('livewire.employee.home.show.info') @endif
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
