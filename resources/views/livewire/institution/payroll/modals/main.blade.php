<x-modal wire:model.defer="showModal">
    <x-card title="Procesos de Nóminas">
        @if ($modeCreate)
            @include('livewire.institution.payroll.form.create')
        @endif
        @if ($modeEdit)
            @include('livewire.institution.payroll.form.edit')
        @endif
        @if ($modeShow)
            @include('livewire.institution.payroll.show.info')
        @endif

        @if ($modeCreate || $modeEdit)
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Calcelar" x-on:click="close" />
                    <x-button primary label="Guardar" wire:click="save" />
                </div>
            </x-slot>
        @endif
    </x-card>
</x-modal>
