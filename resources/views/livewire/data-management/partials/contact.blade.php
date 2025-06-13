<!-- Información de Contacto -->
<div class="mb-8">
    <h2
        class="mb-1 text-gray-800 border-b border-gray-200 text-end font-extralight text-md dark:text-gray-400 dark:border-gray-700">
        Información de Contacto
    </h2>
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <!-- Email -->
        <div>
            <x-wireui-input
                label="Correo Electrónico"
                placeholder="Ingresa tu correo electrónico"
                {{-- suffix="@mail.com" --}}
                type="email"
                wire:model="email"
                id="email"
                :name="Str::random(10)"
            />
        </div>

        <!-- Teléfono -->
        <div>
            <x-wireui-maskable
                id="phone"
                label="Teléfono"
                mask="+## (###) ###-####"
                placeholder="Teléfono"
                wire:model="phone"
                :name="Str::random(10)"
            />
        </div>
    </div>
</div>
