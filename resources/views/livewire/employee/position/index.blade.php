<div>



    <div class="flex justify-between">
        <h2 class="mx-2 text-2xl font-bold">Posiciones y cargos registrados</h2>
        <div>
            {{-- <x-button.circle wire:click="$toggle('showModal')" primary label="+" /> --}}
            <x-button.circle wire:click="openModal('create')" primary label="+" />
        </div>
    </div>

    <div class="px-2">
        @include('livewire.employee.position.partials.table')
    </div>

    <hr class="my-4">

    <div class="flex flex-col md:flex-row">
        <div class="flex-1  m-2 p-2">
            {{-- @include('livewire.employee.autority.partials.info') --}}
        </div>
    </div>

    <hr class="my-4">

    {{-- @include('livewire.employee.autority.partials.indicators') --}}

</div>
