<div>
    @include('livewire.setup.partials.deduction-header')
    @include('livewire.setup.partials.deduction-search')
    @include('livewire.setup.partials.deduction-table')
    @includeWhen($showModal, 'livewire.setup.partials.deduction-modal')
    @includeWhen($showDetailsModal, 'livewire.setup.partials.deduction-details-modal')

    <livewire:loading-indicator />

</div>
