<div>

    <div class="rounded-lg bg-gray-100 p-4">
        <h2 class="text-2xl font-bold mb-6">Solicitud de vacaciones de los empleados registradas</h2>
        @include('livewire.vacation.request.partials.table')
    </div>

    <hr class="my-4">

    <div class="flex flex-col md:flex-row">
        <div class="flex-1">
            <div class="rounded-lg bg-gray-100 p-4">
                <h2 class="text-2xl font-bold mb-6">Registrar una nueva Solicitud de Vacación</h2>
                @include('livewire.vacation.request.partials.form')
            </div>
        </div>
        <div class="flex-1">
            @include('livewire.vacation.request.partials.info')
        </div>
    </div>

    @include('livewire.vacation.request.partials.indicators')



</div>
