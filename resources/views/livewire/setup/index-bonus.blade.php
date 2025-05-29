<div>
    @include('livewire.setup.partials.bonus-header')
    @include('livewire.setup.partials.bonus-search')
    @include('livewire.setup.partials.bonus-table')
    @includeWhen($showModal, 'livewire.setup.partials.bonus-modal')
    @includeWhen($showDetailsModal, 'livewire.setup.partials.bonus-details-modal')

    <livewire:loading-indicator />

</div>
