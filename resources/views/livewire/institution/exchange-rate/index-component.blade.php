<div>
    <x-notifications />
    @include('livewire.institution.exchange-rate.modals.main')

    <section class="mb-4 flex justify-between items-center">
        <h2 class="text-2xl font-bold">Tasas de cambios registradas</h2>
        {{-- <x-button.circle wire:click="openModal('create')" primary label="+" /> --}}
    </section>

    @include('livewire.institution.exchange-rate.partials.table')
</div>
