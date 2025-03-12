<!-- Información de Usuario -->
<div class="mb-8">
    <h2
        class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
        Información de Usuario
    </h2>

    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Nombre -->
        <div>
            <x-wireui-input
                label="Nombre"
                placeholder="Nombre"
                wire:model="user.name"
            />
            {{-- @error('user.name')<span class="text-red-500 text-sm">{{ $message }}</span> @enderror --}}
                
        </div>

        <!-- Nombre de Usuario -->
        <div>
            <x-wireui-input
                label="Nombre de Usuario"
                placeholder="Ingrese el nombre del usuario"
                wire:model="user.username"
            />
            {{-- @error('user.username')<span class="text-red-500 text-sm">{{ $message }}</span> @enderror --}}
            {{-- @error('user.username') <x-wireui-alert :title="$message" negative /> @enderror --}}
                
        </div>

        <!-- Correo Electrónico -->
        <div>

            <x-wireui-input
                label="Correo Electrónico"
                placeholder="ingrese correo electrónico"
                suffix="@mail.com"
                wire:model="user.email"
            />
            {{-- <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Correo Electrónico
            </label>
            <input wire:model="user.email" type="email" id="email"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
            @error('user.email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror --}}
        </div>

        <!-- Contraseña -->
        <div>

            <x-wireui-password label="Contraseña" wire:model="user.password"/>

            {{-- 
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Contraseña
            </label>
            <input wire:model="user.password" type="password" id="password"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
            @error('user.password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            --}}
        </div>
    </div>
</div>