<x-modal wire:model.defer="showModal">

    <x-card title="Posiciones y Cargos">

        <p class="text-gray-600">
            @if ($modeCreate) @include('livewire.employee.position.form.create') @endif
            @if ($modeEdit) @include('livewire.employee.position.form.edit') @endif
            @if ($modeShow) @include('livewire.employee.position.show.info') @endif
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
