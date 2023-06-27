<section class="py-8">
    <div class="container mx-auto px-4">
        <h2 class="text-xl font-semibold mb-4">Indicadores - Empleados</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-4">

            <x-indicators.box.card>
                <x-slot name="title">Costo promedio</x-slot>
                <x-slot name="footer">Costo promedio de las prestaciones sociales por empleado: este indicador mide el costo promedio de las prestaciones sociales que recibe cada empleado. Este indicador es importante para monitorear el presupuesto de la institución y asegurarse de que los costos estén dentro de los límites establecidos.</x-slot>
                <x-slot name="count">100</x-slot>
                <x-slot name="unit">$/Empleado</x-slot>
                {{-- <x-slot name="porc">98</x-slot> --}}
            </x-indicators.box.card>

            <x-indicators.box.card>
                <x-slot name="title">Tasa de retención</x-slot>
                <x-slot name="footer">Tasa de retención de empleados con prestaciones sociales: este indicador mide la tasa de retención de empleados que reciben prestaciones sociales de la institución. Una tasa alta de retención puede indicar una cultura laboral saludable y una mayor valoración de las prestaciones sociales por parte de los empleados.</x-slot>
                <x-slot name="count">10</x-slot>
                <x-slot name="unit">%</x-slot>
                {{-- <x-slot name="porc">98</x-slot> --}}
            </x-indicators.box.card>

            <x-indicators.box.card>
                <x-slot name="title">Tasa de beneficio</x-slot>
                <x-slot name="footer">Tasa de beneficio de las prestaciones sociales: este indicador mide el beneficio que reciben los empleados de las prestaciones sociales ofrecidas por la institución, como el valor monetario o los servicios proporcionados. Una tasa alta de beneficio puede indicar una cultura laboral saludable y una mayor satisfacción de los empleados.</x-slot>
                <x-slot name="count">10</x-slot>
                <x-slot name="unit">%</x-slot>
                {{-- <x-slot name="porc">98</x-slot> --}}
            </x-indicators.box.card>

        </div>
    </div>

</section>
