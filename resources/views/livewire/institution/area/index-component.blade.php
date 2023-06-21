<div>
    <x-notifications />
    @include('livewire.institution.area.modals.main')

    <section class="mb-4 flex justify-between items-center">
        <h2 class="text-2xl font-bold">Áreas registradas</h2>
        <x-button.circle wire:click="openModal('create')" primary label="+" />
    </section>

    @include('livewire.institution.area.partials.table')
</div>
