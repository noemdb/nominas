@php
    $links = [['label' => 'dashboard', 'icon' => 'icons.home'], ['label' => 'dashboard', 'icon' => 'icons.home'], ['label' => 'dashboard', 'icon' => 'icons.home'], ['label' => 'dashboard', 'icon' => 'icons.home'], ['label' => 'dashboard', 'icon' => 'icons.home'], ['label' => 'dashboard', 'icon' => 'icons.home'], ['label' => 'dashboard', 'icon' => 'icons.home'], ['label' => 'dashboard', 'icon' => 'icons.home'], ['label' => 'dashboard', 'icon' => 'icons.home'], ['label' => 'dashboard', 'icon' => 'icons.home']];
@endphp

<header>
    <h1>¡Bienvenido de vuelta!</h1>
</header>
<main>
    <aside class="max-w-xs h-screen p-4 border-r border-solid border-gray-300">
        <nav>
            <ul class="flex flex-col gap-2">
                @foreach ($links as $link)
                    <li>
                        <a href="#" class="p-4 rounded-lg flex gap-4 hover:bg-green-100 hover:text-green-900">
                            <x-dynamic-component :component="$link['icon']" />
                            <span class="capitalize">{{ $link['label'] }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </aside>
    {{ $slot }}
</main>
