<div>
    @include('livewire.setup.partials.payroll-header')
    @include('livewire.setup.partials.payroll-search')
    @include('livewire.setup.partials.payroll-table')
    @includeWhen($showModal, 'livewire.setup.partials.payroll-modal')
    @includeWhen($showCalculateModal, 'livewire.setup.partials.payroll-calculate-modal')
    @includeWhen($showDetailsModal, 'livewire.setup.partials.payroll-details-modal')
    @includeWhen($showReportsModal, 'livewire.setup.partials.payroll-reports-modal')

    <livewire:loading-indicator />

</div>
