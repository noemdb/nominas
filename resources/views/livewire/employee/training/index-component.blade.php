<div>

    <h2 class="text-3xl font-bold mb-6">Formación o capacitación de los empleados</h2>

    <div class="rounded-lg bg-gray-100 p-4">
        <h2 class="text-2xl font-bold mb-6">Informaciones formación/capacitación de los empleados registradas</h2>
        @include('livewire.employee.training.partials.table')
    </div>

    <hr class="my-4">

    <div class="flex flex-col md:flex-row">
        <div class="flex-1  m-2 p-2">
            <div class="rounded-lg bg-gray-100 p-4">
                <h2 class="text-2xl font-bold mb-6">Registrar una nueva formación/capacitación de los empleados</h2>
                @include('livewire.employee.training.partials.form')
            </div>
        </div>
        <div class="flex-1  m-2 p-2">
            @include('livewire.employee.training.partials.info')
        </div>
    </div>

    <hr class="my-4">

    @include('livewire.employee.training.partials.indicators')

</div>
