<!-- Información de Usuario -->
<div class="mb-8">
    <h2
        class="text-end font-extralight text-md text-gray-800 dark:text-gray-400 mb-1 border-b border-gray-200 dark:border-gray-700">
        Información de Usuario
    </h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Nombre de Usuario -->
        <div>
            <x-wireui-input
                label="Nombre de Usuario"
                placeholder="Ingrese el nombre del usuario"
                wire:model="user.username"
                id="user.username" :name="Str::random(10)"
            />
        </div>
        <!-- Contraseña -->
        <div>
            <x-wireui-password label="Contraseña" wire:model="user.password" id="user.password" :name="Str::random(10)"/>
        </div>
    </div>
</div>