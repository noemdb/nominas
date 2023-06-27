<div>

    <div class="rounded-lg bg-gray-100 p-4">
        <h2 class="text-2xl font-bold mb-6">Roles/Cargos registrados</h2>
        @include('livewire.institution.rol.partials.table')
    </div>

    <hr class="my-4">

    <div class="flex flex-col md:flex-row">
        <div class="flex-1  m-2 p-2">
            <div class="rounded-lg bg-gray-100 p-4">
                <h2 class="text-2xl font-bold mb-6">Registro de roles o cargos</h2>
                @include('livewire.institution.rol.partials.form')
            </div>
        </div>
        <div class="flex-1  m-2 p-2">
            @include('livewire.institution.rol.partials.info')
        </div>
    </div>

    <hr class="my-4">

    @include('livewire.institution.rol.partials.indicators')

</div>
