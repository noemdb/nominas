<section class="py-8">
    <div class="container mx-auto px-4">
        <h2 class="text-xl font-semibold mb-4">Indicadores - Empleados</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-4">

            <x-indicators.box.card>
                <x-slot name="title">Tiempo promedio de contratación</x-slot>
                <x-slot name="footer">Este indicador mide el tiempo que tarda la empresa en cubrir una vacante desde que se anuncia hasta que se contrata a un nuevo empleado.</x-slot>
                <x-slot name="count">24</x-slot>
                <x-slot name="unit">Meses</x-slot>
                <x-slot name="porc">98</x-slot>
            </x-indicators.box.card>

            <x-indicators.box.card>
                <x-slot name="title">Índice de satisfacción del empleado</x-slot>
                <x-slot name="footer">Este indicador mide el tiempo que tarda la empresa en cubrir una vacante desde que se anuncia hasta que se contrata a un nuevo empleado.</x-slot>
                <x-slot name="count">79</x-slot>
                <x-slot name="unit">%</x-slot>
                <x-slot name="porc">79</x-slot>
            </x-indicators.box.card>

            <x-indicators.box.card>
                <x-slot name="title">Costo por contratación</x-slot>
                <x-slot name="footer">Este indicador mide el tiempo que tarda la empresa en cubrir una vacante desde que se anuncia hasta que se contrata a un nuevo empleado.</x-slot>
                <x-slot name="count">34</x-slot>
                <x-slot name="unit">Mil</x-slot>
                <x-slot name="porc">12</x-slot>
            </x-indicators.box.card>

            <x-indicators.box.card>
                <x-slot name="title">Índice de absentismo laboral</x-slot>
                <x-slot name="footer">Este indicador mide el porcentaje de empleados que faltan al trabajo sin justificación en un período determinado</x-slot>
                <x-slot name="count">14</x-slot>
                <x-slot name="unit">%</x-slot>
                <x-slot name="porc">14</x-slot>
            </x-indicators.box.card>

            <x-indicators.box.card>
                <x-slot name="title">Tasa de capacitación y formación</x-slot>
                <x-slot name="footer">Tasa de capacitación y formación: este indicador mide la tasa de capacitación y formación con que cuentan los empleados. Una tasa alta puede indicar un compromiso con el desarrollo profesional de los empleados y una cultura de aprendizaje continuo.</x-slot>
                <x-slot name="count">5</x-slot>
                <x-slot name="unit">Títulos/Empleado</x-slot>
                {{-- <x-slot name="porc">14</x-slot> --}}
            </x-indicators.box.card>

        </div>
    </div>

</section>
