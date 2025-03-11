<!-- Información Personal -->
<div class="mb-8">
    <h2
        class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
        Información Personal
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Nombre -->
        <div>
            <label for="first_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Nombre
            </label>
            <input wire:model="worker.first_name" type="text" id="first_name"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
            @error('worker.first_name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Apellido -->
        <div>
            <label for="last_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Apellido
            </label>
            <input wire:model="worker.last_name" type="text" id="last_name"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
            @error('worker.last_name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Cédula -->
        <div>
            <label for="identification" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Cédula
            </label>
            <input wire:model="worker.identification" type="text" id="identification"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
            @error('worker.identification')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Fecha de Nacimiento -->
        <div>
            <label for="birth_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Fecha de Nacimiento
            </label>
            <input wire:model="worker.birth_date" type="date" id="birth_date"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
            @error('worker.birth_date')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Género -->
        <div>
            <label for="gender" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Género
            </label>
            <select wire:model="worker.gender" id="gender"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                <option disabled selected>Seleccione un género</option>
                <option value="male">Masculino</option>
                <option value="female">Femenino</option>
                <option value="other">Otro</option>
            </select>
            @error('worker.gender')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Estado Civil -->
        <div>
            <label for="marital_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Estado Civil
            </label>
            <select wire:model="worker.marital_status" id="marital_status"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                <option value="single">Soltero/a</option>
                <option value="married">Casado/a</option>
                <option value="divorced">Divorciado/a</option>
                <option value="widowed">Viudo/a</option>
            </select>
            @error('worker.marital_status')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Nacionalidad -->
        <div>
            <label for="nationality" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Nacionalidad
            </label>
            <input wire:model="worker.nationality" type="text" id="nationality"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
            @error('worker.nationality')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
