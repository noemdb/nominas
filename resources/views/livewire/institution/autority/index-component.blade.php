<div>
    <x-notifications />
    @include('livewire.institution.autority.modals.main')

    <section class="mb-4 flex justify-between items-center">
        <h2 class="text-2xl font-bold">Autoridades registradas</h2>
        <x-button.circle wire:click="openModal('create')" primary label="+" />
    </section>

    @include('livewire.institution.autority.partials.table')
</div>

{{-- <div class="flex flex-col md:flex-row">
        <div class="flex-1  m-2 p-2">
            <div class="rounded-lg bg-gray-100 p-4">
                <div class="text-xl lg:text-2xl text-start">Registrar nueva autoridad</div>
                @include('livewire.institution.autority.partials.form')
            </div>
        </div>
        <div class="flex-1  m-2 p-2">
            @include('livewire.institution.autority.partials.info')
        </div>
    </div>

    <hr class="my-4">

    @include('livewire.institution.autority.partials.indicators') --}}
