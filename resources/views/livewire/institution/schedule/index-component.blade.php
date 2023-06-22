<div>

    <div class="rounded-lg bg-gray-100 p-4">
        <div class="text-xl lg:text-2xl text-start">Horarios laborales registrados</div>
        @include('livewire.institution.schedule.partials.table')
    </div>

    <hr class="my-4">

    <div class="flex flex-col md:flex-row">
        <div class="flex-1  m-2 p-2">
            <div class="rounded-lg bg-gray-100 p-4">
                <div class="text-xl lg:text-2xl text-start">Registrar nuevo Horario laboral</div>
                @include('livewire.institution.schedule.partials.form')
            </div>
        </div>
        <div class="flex-1  m-2 p-2">
            @include('livewire.institution.schedule.partials.info')
        </div>
    </div>

    <hr class="my-4">

    @include('livewire.institution.schedule.partials.indicators')

</div>
