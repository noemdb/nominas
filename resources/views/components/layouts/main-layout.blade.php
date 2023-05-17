@php
    $links = [
        [
            'label' => 'dashboard',
            'icon' => 'icons.home',
            'childrens' => [['label' => 'Nested', 'icon' => 'icons.home'], ['label' => 'Nested', 'icon' => 'icons.home'], ['label' => 'Nested', 'icon' => 'icons.home'], ['label' => 'Nested', 'icon' => 'icons.home']],
        ],
        ['label' => 'dashboard2', 'icon' => 'icons.home'],
        ['label' => 'dashboard3', 'icon' => 'icons.home'],
        ['label' => 'dashboard4', 'icon' => 'icons.home'],
        ['label' => 'dashboard5', 'icon' => 'icons.home'],
        ['label' => 'dashboard6', 'icon' => 'icons.home'],
        ['label' => 'dashboard7', 'icon' => 'icons.home'],
        ['label' => 'dashboard8', 'icon' => 'icons.home'],
        ['label' => 'dashboard9', 'icon' => 'icons.home'],
        [
            'label' => 'dashboard10',
            'icon' => 'icons.home',
            'childrens' => [['label' => 'Nested', 'icon' => 'icons.home'], ['label' => 'Nested', 'icon' => 'icons.home'], ['label' => 'Nested', 'icon' => 'icons.home'], ['label' => 'Nested', 'icon' => 'icons.home']],
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
</head>

<body class="antialiased text-neutral-800">
    <main class="flex relative">
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
                <h1 class="text-xl">¡Bienvenido de vuelta!</h1>
                <button class="w-8 h-8 bg-green-600 rounded-full flex justify-center items-center">
                    <h6 class="text-white/90">A</h6>
                </button>
            </header>
            {{ $slot }}
        </div>
    </main>
    @stack('tree')
    @stack('aside')
</body>

</html>
