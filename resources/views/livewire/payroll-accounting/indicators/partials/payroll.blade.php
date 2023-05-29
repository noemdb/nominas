<section class="py-8">
    <div class="container mx-auto px-4">
        <h2 class="text-xl font-semibold mb-4">Indicadores - Empleados</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-4">

            <x-indicators.box.card>
                <x-slot name="title">Costo promedio de la nómina por empleado</x-slot>
                <x-slot name="footer">Costo promedio de la nómina por empleado: este indicador mide el costo promedio de la nómina por empleado, incluyendo salarios, impuestos y deducciones. Este indicador es importante para monitorear el presupuesto de la institución y asegurarse de que los costos estén dentro de los límites establecidos.</x-slot>
                <x-slot name="count">50k</x-slot>
                <x-slot name="unit">$</x-slot>
                {{-- <x-slot name="porc">98</x-slot> --}}
            </x-indicators.box.card>

            <x-indicators.box.card>
                <x-slot name="title">Tasa de cumplimiento de los plazos de pago</x-slot>
                <x-slot name="footer">Tasa de cumplimiento de los plazos de pago: este indicador mide la tasa de cumplimiento de los plazos de pago de nóminas establecidos por la institución. Una tasa alta de cumplimiento puede indicar un compromiso de la institución con el pago oportuno de las nóminas.</x-slot>
                <x-slot name="count">99.8</x-slot>
                <x-slot name="unit">%</x-slot>
                {{-- <x-slot name="porc">79</x-slot> --}}
            </x-indicators.box.card>

            <x-indicators.box.card>
                <x-slot name="title">Tasa de cumplimiento/talentos</x-slot>
                <x-slot name="footer">Tasa de cumplimiento de las políticas de retención de talentos: este indicador mide la tasa de cumplimiento de las políticas de retención de talentos de la institución, como la asignación de bonificaciones o programas de incentivos a largo plazo. Una tasa alta de cumplimiento puede indicar una cultura laboral que valora y retiene el talento.</x-slot>
                <x-slot name="count">100</x-slot>
                <x-slot name="unit">%</x-slot>
                {{-- <x-slot name="porc">12</x-slot> --}}
            </x-indicators.box.card>

        </div>
    </div>

</section>
