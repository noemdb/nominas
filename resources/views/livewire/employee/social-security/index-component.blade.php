<div>

    <div class="rounded-lg bg-gray-100 p-4">
        <h2 class="text-2xl font-bold mb-6">Informaciones de seguridad social registradas</h2>
        @include('livewire.employee.social-security.partials.table')
    </div>

    <hr class="my-4">

    <div class="flex flex-col md:flex-row">
        <div class="flex-1  m-2 p-2">
            <div class="rounded-lg bg-gray-100 p-4">
                <h2 class="text-2xl font-bold mb-6">Registrar una nueva Información de seguridad social</h2>
                @include('livewire.employee.social-security.partials.form')
            </div>
        </div>
        <div class="flex-1  m-2 p-2">
            @include('livewire.employee.social-security.partials.info')
        </div>
    </div>

    <hr class="my-4">

    @include('livewire.employee.social-security.partials.indicators')

</div>

