<div>
    <x-notifications />
    @include('livewire.institution.bank.modals.main')

    <section class="mb-4 flex justify-between items-center">
        <h2 class="text-2xl font-bold">Bancos registrados</h2>
        <x-button.circle wire:click="openModal('create')" primary label="+" />
    </section>

    @include('livewire.institution.bank.partials.table')
</div>
