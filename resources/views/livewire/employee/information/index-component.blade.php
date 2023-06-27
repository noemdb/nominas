
<div>

    <div class="rounded-lg bg-gray-100 p-4">
        <h2 class="text-2xl font-bold mb-6">Informaciones laborales registradas</h2>
        @include('livewire.employee.information.partials.table')
    </div>

    <hr class="my-4">

    <div class="flex flex-col md:flex-row">
        <div class="flex-1  m-2 p-2">
            <div class="rounded-lg bg-gray-100 p-4">
                <h2 class="text-2xl font-bold mb-6">Registrar una nueva Información laboral</h2>
                @include('livewire.employee.information.partials.form')
            </div>
        </div>
        <div class="flex-1  m-2 p-2">
            @include('livewire.employee.information.partials.info')
        </div>
    </div>

    <hr class="my-4">

    @include('livewire.employee.information.partials.indicators')

</div>

