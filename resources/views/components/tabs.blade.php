@props([
    'tabs' => [],
    'activeTab' => null,
    'storageKey' => 'activeTab'
])

<div x-data="{
    tab: localStorage.getItem('{{ $storageKey }}') || '{{ $activeTab }}',
    setActiveTab(tab) {
        this.tab = tab;
        localStorage.setItem('{{ $storageKey }}', tab);
    }
}" x-cloak>
    <!-- Navegación de Pestañas -->
    <div class="flex mb-6 space-x-4 border-b border-gray-200 dark:border-gray-700">
        @foreach($tabs as $key => $label)
            <button @click="setActiveTab('{{ $key }}')"
                :class="tab === '{{ $key }}' ? 'border-b-2 border-blue-500 text-blue-500 font-semibold' : 'text-gray-600'"
                class="px-4 py-2 transition focus:outline-none">
                {{ $label }}
            </button>
        @endforeach
    </div>

    <!-- Contenido de las Pestañas -->
    <div>
        {{ $slot }}
    </div>
</div>
