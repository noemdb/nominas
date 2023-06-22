<section class="py-8">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-semibold mb-4">Indicadores - Empleados</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-4">

            <x-indicators.box.card>
                <x-slot name="title">Tasa de actualización.</x-slot>
                <x-slot name="footer">Tasa de actualización de la información personal: este indicador mide con qué frecuencia los empleados actualizan su información personal en el sistema de gestión de nómina. Una tasa alta de actualización puede indicar un compromiso de los empleados con mantener su información personal actualizada y precisa.</x-slot>
                <x-slot name="count">5</x-slot>
                <x-slot name="unit">/Mes</x-slot>
                {{-- <x-slot name="porc">98</x-slot> --}}
            </x-indicators.box.card>
            <x-indicators.box.card>
                <x-slot name="title">Tasa de carga familiar.</x-slot>
                <x-slot name="footer">Este indicador mide la carga familiar de los empleados, es decir, el número de dependientes que tienen (como hijos menores de edad). Una tasa alta de carga familiar puede indicar una necesidad de políticas de apoyo para los empleados con responsabilidades familiares.</x-slot>
                <x-slot name="count">3</x-slot>
                <x-slot name="unit">/Empleado</x-slot>
                {{-- <x-slot name="porc">98</x-slot> --}}
            </x-indicators.box.card>
            <x-indicators.box.card>
                <x-slot name="title">Tasa de cumplimiento diversidad/inclusión.</x-slot>
                <x-slot name="footer">Este indicador mide la tasa decumplimiento de las políticas de diversidad e inclusión por parte de los empleados. Una tasa alta de cumplimiento puede indicar un compromiso de los empleados con la diversidad y la inclusión en el lugar de trabajo.</x-slot>
                <x-slot name="count">100</x-slot>
                <x-slot name="unit">%</x-slot>
                {{-- <x-slot name="porc">98</x-slot> --}}
            </x-indicators.box.card>

        </div>
    </div>

</section>
