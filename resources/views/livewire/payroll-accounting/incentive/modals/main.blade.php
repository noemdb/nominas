<x-modal wire:model.defer="showModal">
    <x-card title="Incentivo">
        @if ($modeCreate)
            @include('livewire.payroll-accounting.incentive.form.create')
        @endif
        @if ($modeEdit)
            @include('livewire.payroll-accounting.incentive.form.edit')
        @endif
        @if ($modeShow)
            @include('livewire.payroll-accounting.incentive.show.info')
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
