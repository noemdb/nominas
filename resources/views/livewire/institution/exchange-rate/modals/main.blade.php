<x-modal wire:model.defer="showModal">
    <x-card title="Tasa de Cambio">
        @if ($modeShow)
            @include('livewire.institution.exchange-rate.show.info')
        @endif
    </x-card>
</x-modal>
