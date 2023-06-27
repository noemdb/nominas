<section class="py-8">

    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-semibold mb-4">Indicadores de gestión de vacaciones</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-4">

            <x-indicators.box.card>
                <x-slot name="title">Días promedio de vacaciones</x-slot>
                <x-slot name="footer">Días promedio de vacaciones utilizados por empleado. Un número alto podría indicar una buena política de vacaciones y un ambiente laboral saludable</x-slot>
                <x-slot name="count">12</x-slot>
                <x-slot name="unit">Días</x-slot>
                {{-- <x-slot name="porc">54</x-slot> --}}
            </x-indicators.box.card>

            <x-indicators.box.card>
                <x-slot name="title">Tiempo promedio de respuesta.</x-slot>
                <x-slot name="footer">Tiempo promedio de respuesta a las solicitudes de vacaciones. Un tiempo de respuesta rápido puede mejorar la satisfacción del empleado y la eficiencia del proceso.</x-slot>
                <x-slot name="count">3</x-slot>
                <x-slot name="unit">Días</x-slot>
                {{-- <x-slot name="porc">54</x-slot> --}}
            </x-indicators.box.card>

            <x-indicators.box.card>
                <x-slot name="title">Tasa de aprobación.</x-slot>
                <x-slot name="footer">Tasa de aprobación de solicitudes de vacaciones. Una tasa de aprobación alta podría indicar una buena planificación de las vacaciones y una cultura laboral saludable.</x-slot>
                <x-slot name="count">80</x-slot>
                <x-slot name="unit">%</x-slot>
                {{-- <x-slot name="porc">54</x-slot> --}}
            </x-indicators.box.card>

            <x-indicators.box.card>
                <x-slot name="title">Días promedio.</x-slot>
                <x-slot name="footer">Días promedio de vacaciones utilizados por empleado. Un número alto podría indicar una buena política de vacaciones y un ambiente laboral saludable.</x-slot>
                <x-slot name="count">19</x-slot>
                <x-slot name="unit">Días</x-slot>
                {{-- <x-slot name="porc">54</x-slot> --}}
            </x-indicators.box.card>

            <x-indicators.box.card>
                <x-slot name="title">Tasa de no presentación.</x-slot>
                <x-slot name="footer">Tasa de no presentación después de las vacaciones. Si la tasa es alta, podría indicar una mala planificación de las vacaciones o una cultura laboral poco saludable.</x-slot>
                <x-slot name="count">12</x-slot>
                <x-slot name="unit">%</x-slot>
                {{-- <x-slot name="porc">54</x-slot> --}}
            </x-indicators.box.card>

        </div>
    </div>

</section>


