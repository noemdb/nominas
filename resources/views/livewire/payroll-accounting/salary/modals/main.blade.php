<x-modal wire:model.defer="showModal">
    <x-card title="Monedas">
        @if ($modeCreate)
            @include('livewire.payroll-accounting.salary.form.create')
        @endif
        @if ($modeEdit)
            @include('livewire.payroll-accounting.salary.form.edit')
        @endif
        @if ($modeShow)
            @include('livewire.payroll-accounting.salary.show.info')
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
