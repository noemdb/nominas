@php
    $links = [
        ['label' => 'dashboard', 'icon' => 'icons.home', 'childrens' => [['label' => 'Nested', 'icon' => 'icons.home']]],
        ['label' => 'dashboard2', 'icon' => 'icons.home'],
        ['label' => 'dashboard3', 'icon' => 'icons.home'],
        ['label' => 'dashboard4', 'icon' => 'icons.home'],
        ['label' => 'dashboard5', 'icon' => 'icons.home'],
        ['label' => 'dashboard6', 'icon' => 'icons.home'],
        ['label' => 'dashboard7', 'icon' => 'icons.home'],
        ['label' => 'dashboard8', 'icon' => 'icons.home'],
        ['label' => 'dashboard9', 'icon' => 'icons.home'],
        ['label' => 'dashboard10', 'icon' => 'icons.home']
    ];
@endphp

<main class="flex relative">
    <aside
        class="w-full h-screen p-4 bg-white hidden fixed inset-0 [&.open]:block lg:w-72 lg:bg-transparent lg:border-r lg:border-solid lg:border-gray-300 lg:block lg:relative">
        <x-aside-nav :links="$links" />
    </aside>
    <div>
        <header>
            <h1>¡Bienvenido de vuelta!</h1>
        </header>
        {{ $slot }}
    </div>
</main>
