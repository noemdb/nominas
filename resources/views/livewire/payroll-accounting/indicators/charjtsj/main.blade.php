<h2 class="text-lg font-medium text-gray-800 mb-4">Indicadores de Gestión de Empleados</h2>

<div class="flex flex-col md:flex-row">

    <div class="flex-1 p-2 m-2">
        <div class="max-w-xl">
            @php $chartjs = 'test-1'; $data="5, 9, 3, 6"; @endphp
            @include('livewire.employee.indicators.charjtsj.partials.employees')

        </div>
    </div>
    <div class="flex-1 p-2 m-2">
        <div class="max-w-xl">
            @php $chartjs = 'test-2'; $data="2, 12, 4, 12"; @endphp
            @include('livewire.employee.indicators.charjtsj.partials.employees')
        </div>
    </div>

</div>

@prepend('scripts') <script src={{asset("js/chart.js")}}></script> @endprepend





