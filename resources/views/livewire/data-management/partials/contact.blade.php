<!-- Información de Contacto -->
<div class="mb-8">
    <h2
        class="text-end font-extralight text-md text-gray-800 dark:text-gray-400 mb-1 border-b border-gray-200 dark:border-gray-700">
        Información de Contacto
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Email -->
        <div>

            <x-wireui-input
                label="Correo Electrónico"
                placeholder="Ingresa tu correo electrónico"
                suffix="@mail.com"
                type="email"
                wire:model="worker.email"
            />
        </div>

        <!-- Teléfono -->
        <div>
            <x-wireui-maskable
                id="phone-mask"
                label="Teléfono"
                mask="+## (###) ###-####"
                placeholder="Teléfono"
                wire:model="worker.phone"
            />
        </div>
    </div>
</div>