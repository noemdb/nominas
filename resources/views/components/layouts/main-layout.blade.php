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
            font-family: "Inter-Regular";
            src: url("{{ asset('fonts/Inter-Regular.ttf') }}");
            font-style: normal;
            font-weight: 400;
        }
    </style>
</head>

<body class="antialiased text-neutral-800">
    <main class="flex relative">
        <x-sidebar name="main-nav">
            <div class="lg:hidden">
                <button data-sidebar-close="main-nav">Close</button>
            </div>
            <x-tree :links="$links" />
        </x-sidebar>
        <div class="lg:ml-80">
            <header>
                <div class="lg:hidden">
                    <button data-sidebar-open="main-nav">Open</button>
                </div>
                <h1>¡Bienvenido de vuelta!</h1>
            </header>
            {{ $slot }}
        </div>
    </main>
    @stack('tree')
    @stack('aside')
</body>

</html>
