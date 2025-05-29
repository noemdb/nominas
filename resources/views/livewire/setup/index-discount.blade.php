<div>
    @include('livewire.setup.partials.discount-header')
    @include('livewire.setup.partials.discount-search')
    @include('livewire.setup.partials.discount-table')
    @includeWhen($showModal, 'livewire.setup.partials.discount-modal')
    @includeWhen($showDetailsModal, 'livewire.setup.partials.discount-details-modal')

    <livewire:loading-indicator />
</div>
