<div>
    <x-notifications />
    @include('livewire.payroll-accounting.incentive.modals.main')

    <section class="mb-4 flex justify-between items-center">
        <h2 class="text-2xl font-bold">Incentivos registradas</h2>
        <x-button.circle wire:click="openModal('create')" primary label="+" />
    </section>

    @include('livewire.payroll-accounting.incentive.partials.table')
</div>
