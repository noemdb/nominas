@php
    $links = [
        ['label' => 'dashboard', 'icon' => 'icons.home', 'route' => route('welcome')],
        [
            'label' => 'instituciones',
            'icon' => 'icons.building',
            'childrens' => [
                ['label' => 'Autoridades', 'route' => route('institutions.autorities')],
                ['label' => 'Bancos', 'route' => route('institutions.banks')],
                ['label' => 'Horarios', 'route' => route('institutions.schedules')],
                ['label' => 'Roles', 'route' => route('institutions.rols')],
                ['label' => 'Especiales', 'route' => route('institutions.specials')],
            ],
        ],
        [
            'label' => 'Empleados',
            'icon' => 'icons.user-group',
            'childrens' => [
                ['label' => 'Personal', 'route' => route('employees.personals')],
                ['label' => 'Información', 'route' => route('employees.informations')],
                ['label' => 'Salarios', 'route' => route('employees.salaries')],
                ['label' => 'Seguridad social', 'route' => route('employees.social')],
                ['label' => 'Entrenamientos', 'route' => route('employees.trainings')],
                ['label' => 'Documentación', 'route' => route('employees.documentations')],
            ],
        ],
        [
            'label' => 'Formulaciones',
            'icon' => 'icons.math',
            'childrens' => [
                ['label' => 'Nómina', 'route' => route('formulations.payrolls')],
                ['label' => 'Beneficios sociales', 'route' => route('formulations.social-benefits')],
                ['label' => 'Vacaciones', 'route' => route('formulations.vacations')],
            ],
        ],
        [
            'label' => 'Nómina',
            'icon' => 'icons.hand-cash',
            'childrens' => [
                ['label' => 'Salarios', 'route' => route('payroll-accountings.salaries')],
                ['label' => 'Deducciones', 'route' => route('payroll-accountings.deductions')],
                ['label' => 'Bonificaciones', 'route' => route('payroll-accountings.bonifications')],
                ['label' => 'Incentivos', 'route' => route('payroll-accountings.incentives')],
                ['label' => 'Sobretiempos', 'route' => route('payroll-accountings.overtimes')],
                ['label' => 'Días feriados', 'route' => route('payroll-accountings.holidays')],
                ['label' => 'Vacaciones', 'route' => route('payroll-accountings.vacations')],
                ['label' => 'Pago de recibos', 'route' => route('payroll-accountings.payment-vouchers')],
            ],
        ],
        [
            'label' => 'Beneficios sociales',
            'icon' => 'icons.hand-heart',
            'childrens' => [
                ['label' => 'Registros', 'route' => route('social-benefits.registers')],
                ['label' => 'Gestión de préstamos', 'route' => route('social-benefits.loan-managements')],
                ['label' => 'Reportes', 'route' => route('social-benefits.reports')],
            ],
        ],
    ];
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="preload" href="{{ asset('fonts/Inter-Regular.ttf') }}" as="font" type="font/ttf" crossorigin>

    <style>
        @font-face {
            font-family: "Inter";
            src: url("{{ asset('fonts/Inter-Regular.ttf') }}");
            font-style: normal;
            font-weight: 400;
        }

        @font-face {
            font-family: "Inter";
            src: url("{{ asset('fonts/Inter-Bold.ttf') }}");
            font-style: normal;
            font-weight: 700;
        }
    </style>

    {{-- styles custom --}}
    @stack('styles')

    @livewireStyles

</head>

<body class="antialiased text-neutral-800">
    <div class="flex relative">
        <x-sidebar name="main-nav">
            <div class="m-4 flex lg:hidden">
                <button class="w-7 h-7 ml-auto" data-sidebar-close="main-nav">
                    <x-icons.cross></x-icons.cross>
                </button>
            </div>
            <x-tree :links="$links" />
        </x-sidebar>
        <div class="w-full h-full lg:ml-80 [&>*]:p-4 [&>*]:lg:py-4 [&>*]:lg:px-10">
            <header class="border-b border-solid border-neutral-200 pb-4 flex justify-between items-center">
                <div class="lg:hidden">
                    <button class="w-7 h-7" data-sidebar-open="main-nav">
                        <x-icons.burger></x-icons.burger>
                    </button>
                </div>
                <h1 class="text-xl lg:text-2xl">¡Bienvenido de vuelta!</h1>
                <button class="w-8 h-8 bg-green-600 rounded-full flex justify-center items-center">
                    <h6 class="text-white/90">A</h6>
                </button>
            </header>
            {{ $slot }}
        </div>
    </div>

    @stack('tree')
    @stack('aside')

    {{-- scripts custom --}}
    @stack('scripts')

    @livewireScripts

</body>

</html>
