<div>

    <div class="rounded-lg bg-gray-100 p-4">
        <div class="text-xl lg:text-2xl text-start">Bancos registrados</div>
        @include('livewire.institution.bank.partials.table')
    </div>

    <hr class="my-4">

    <div class="flex flex-col md:flex-row">
        <div class="flex-1  m-2 p-2">
            <div class="rounded-lg bg-gray-100 p-4">
                <div class="text-xl lg:text-2xl text-start">Registrar nuevo Banco</div>
                @include('livewire.institution.bank.partials.form')
            </div>
        </div>
        <div class="flex-1  m-2 p-2">
            @include('livewire.institution.bank.partials.info')
        </div>
    </div>

    <hr class="my-4">

    {{-- @include('livewire.institution.bank.partials.indicators') --}}

</div>
