<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Descuentos') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-4 text-gray-900 dark:text-gray-100">

                    @livewire('setup.index-discount')

                    {{-- <livewire:data-management.workers-manager /> --}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
