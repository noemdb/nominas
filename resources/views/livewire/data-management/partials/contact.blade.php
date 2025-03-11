<!-- Información de Contacto -->
<div class="mb-8">
    <h2
        class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
        Información de Contacto
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Correo Electrónico
            </label>
            <input wire:model="worker.email" type="email" id="email"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
            @error('worker.email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Teléfono -->
        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Teléfono
            </label>
            <input wire:model="worker.phone" type="text" id="phone"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
            @error('worker.phone')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>