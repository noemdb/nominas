<div>
    <div class="rounded-lg bg-gray-100 p-4">
        <div class="text-xl lg:text-2xl text-start">Horarios laborales registrados</div>
        @include('livewire.institution.schedule.partials.table')
    </div>

    <hr class="my-4">

    <div class="rounded-lg bg-gray-100 p-4">
        <div class="text-xl lg:text-2xl text-start">Registrar nuevo Horario laboral</div>
        @include('livewire.institution.schedule.partials.form')
    </div>
</div>
