<div>

    <x-notifications />

    <div class="flex justify-between">
        <h2 class="mb-4 text-2xl font-bold">Instituciones registradas</h2>
        <div>
            {{-- @include('livewire.institution.home.modals.create') --}}
        </div>
    </div>

    <div class="rounded-lg bg-gray-100 p-4">
        @include('livewire.institution.home.partials.table')
    </div>

    <hr class="my-4">

    <div class="flex flex-col md:flex-row">
        <div class="flex-1  m-2 p-2">
            {{-- @include('livewire.institution.autority.partials.info') --}}
        </div>
    </div>

    <hr class="my-4">

    {{-- @include('livewire.institution.autority.partials.indicators') --}}

</div>

