@props([
    'title' => '',
    'maxWidth' => '2xl',
    'closeAction' => 'closeModal',
    'headerClass' => 'bg-white dark:bg-gray-800',
    'fullHeight' => true
])

<div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-400 bg-opacity-40">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-{{ $maxWidth }} flex flex-col {{ $fullHeight ? 'h-[95vh]' : 'max-h-[90vh]' }}">
        <!-- Encabezado del modal -->
        <div class="p-6 border-b border-gray-200 dark:border-gray-700 {{ $headerClass }}">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ $title }}
                </h3>
                <button wire:click="{{ $closeAction }}" class="text-gray-400 hover:text-gray-500">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Contenido del modal con scroll -->
        <div class="flex-grow p-4 overflow-y-auto {{ $fullHeight ? 'h-[calc(95vh-5rem)]' : '' }}">
            {{ $slot }}
        </div>
    </div>
</div>
