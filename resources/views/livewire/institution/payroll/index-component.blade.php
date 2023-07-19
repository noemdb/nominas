<div>
    <x-notifications />
    @include('livewire.institution.payroll.modals.main')

    <section class="mb-4 flex justify-between items-center">
        <h2 class="text-2xl font-bold">Procesos de nóminas</h2>
        <x-button.circle wire:click="openModal('create')" primary label="+" />
    </section>

    @include('livewire.institution.payroll.partials.table')
</div>
