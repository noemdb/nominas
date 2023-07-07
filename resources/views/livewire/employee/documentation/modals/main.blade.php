<x-modal wire:model.defer="showModal" max-width="4xl">

    <x-card title="Documentaciones.">

        <p class="text-gray-600">
            @if ($modeCreate) @include('livewire.employee.documentation.form.create') @endif
            @if ($modeEdit) @include('livewire.employee.documentation.form.edit') @endif
            @if ($modeShow) @include('livewire.employee.documentation.show.info') @endif
            @if ($modeShowFile) @include('livewire.employee.documentation.show.file') @endif
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
