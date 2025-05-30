<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Horarios Semanales') }}
        </h2>
    </x-slot>

    <div class="flex-1 w-full h-full py-6">
        <div class="h-full mx-auto sm:px-6 lg:px-8">
            <div class="h-full overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="h-full p-4 text-gray-900 dark:text-gray-100">
                    @livewire('data-management.weekly-work-schedule-management')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
