<div wire:init="setLoaded" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-75"
    x-data="{ show: true }" x-show="show" x-init="$wire.$on('component-loaded', () => { setTimeout(() => { show = false }, 300) })">
    <div class="flex flex-col items-center justify-center space-y-3 text-white">
        <svg class="w-12 h-12 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
            </path>
        </svg>
        <p class="text-lg font-semibold">Cargando componente...</p>
    </div>
</div>