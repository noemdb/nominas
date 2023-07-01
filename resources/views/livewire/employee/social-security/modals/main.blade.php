<x-modal wire:model.defer="showModal">
    <x-card title="Seguridad Social">
        @if ($modeCreate)
            @include('livewire.employee.social-security.form.create')
        @endif
        @if ($modeEdit)
            @include('livewire.employee.social-security.form.edit')
        @endif
        @if ($modeShow)
            @include('livewire.employee.social-security.show.info')
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
