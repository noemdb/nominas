<div>
    <x-notifications />
    @include('livewire.institution.schedule.modals.main')

    <section class="mb-4 flex justify-between items-center">
        <h2 class="text-2xl font-bold">Horarios registrados</h2>
        <x-button.circle wire:click="openModal('create')" primary label="+" />
    </section>

    @include('livewire.institution.schedule.partials.table')
</div>
