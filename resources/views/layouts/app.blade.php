<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        {{-- <link rel="preconnect" href="https://fonts.bunny.net"> --}}
        {{-- <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}

        <!-- CustomLivewireStyles -->
        @livewireStyles

        @wireUiScripts

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @yield('styles')

        <style>
            [x-cloak] { display: none !important; }
        </style>

        <link rel="webside icon" href="{{asset('image/icon.png')}}" type="png">

    </head>

    <body class="font-sans antialiased">

        <x-wireui-notifications />

        <x-wireui-dialog />

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow dark:bg-gray-800">
                    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

        </div>

        @livewireScripts
        {{-- @livewireScriptConfig --}}

        <!-- CustomLivewireJS -->
        @yield('scripts')

    </body>

</html>
