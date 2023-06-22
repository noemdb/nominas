<div>

    <div class="rounded-lg bg-gray-100 p-4">
        <h2 class="text-2xl font-bold mb-6">Informaciones personales registradas</h2>
        @include('livewire.employee.personal.partials.table')
    </div>

    <hr class="my-4">

    <div class="flex flex-col md:flex-row">
        <div class="flex-1  m-2 p-2">
            <div class="rounded-lg bg-gray-100 p-4">
                <h2 class="text-2xl font-bold mb-6">Registrar una nueva Información personal</h2>
                @include('livewire.employee.personal.partials.form')
            </div>
        </div>
        <div class="flex-1  m-2 p-2">
            @include('livewire.employee.personal.partials.info')
        </div>
    </div>

    <hr class="my-4">

    @include('livewire.employee.personal.partials.indicators')
    {{-- @include('livewire.employee.indicators.partials.staffRotation') --}}

</div>

{{--

    --}}
