<div>
    <x-notifications />
    @include('livewire.employee.social-security.modals.main')

    <section class="mb-4 flex justify-between items-center">
        <h2 class="text-2xl font-bold">Trabajos previos registrados</h2>
        <x-button.circle wire:click="openModal('create')" primary label="+" />
    </section>

    @include('livewire.employee.social-security.partials.table')
</div>
