<!-- Información de Usuario -->
<div class="mb-8">
    <h2
        class="mb-1 text-gray-800 border-b border-gray-200 text-end font-extralight text-md dark:text-gray-400 dark:border-gray-700">
        Información de Usuario
    </h2>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <!-- Nombre de Usuario -->
        <div>
            <x-wireui-input
                label="Nombre de Usuario"
                placeholder="Ingrese el nombre del usuario"
                wire:model="username"
                id="user.username"
                :name="Str::random(10)"
            />
        </div>
        <!-- Contraseña -->
        <div>
            <x-wireui-password
                label="Contraseña"
                wire:model="password"
                id="user.password"
                :name="Str::random(10)"
            />
        </div>
    </div>
</div>
