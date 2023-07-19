<div>
    <x-notifications />
    @include('livewire.payroll-accounting.settlement.modals.main')

    <section class="mb-4 flex justify-between items-center">
        <h2 class="text-2xl font-bold">Liquidaciones de nóminas registradas.</h2>
        <x-button.circle wire:click="openModal('settlement')" primary label="+" />
    </section>

    @include('livewire.payroll-accounting.settlement.partials.table')

</div>
