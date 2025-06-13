<!-- Información Personal -->
<div class="mb-8">
    <h2
        class="mb-1 text-gray-800 border-b border-gray-200 text-end font-extralight text-md dark:text-gray-400 dark:border-gray-700">
        Información Personal
    </h2>
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        <!-- Nombre -->
        <div>

            <x-wireui-input
                wire:model.live="first_name"
                label="Nombre"
                placeholder="Ingrese el nombre"
            />
        </div>

        <!-- Apellido -->
        <div>
            <x-wireui-input
                label="Apellido"
                placeholder="Ingrese el apellido"
                wire:model.live="last_name"
            />
        </div>

        <!-- Cédula -->
        <div>
            <x-wireui-input
                label="Cédula"
                placeholder="Ingrese la cédula"
                wire:model.live="identification"
            />
        </div>

        <x-wireui-datetime-picker
            wire:model.live="birth_date"
            label="Fecha de Nacimiento"
            placeholder="Seleccione"
            display-format="DD-MM-YYYY"
            without-time="true"
        />

        <!-- Género -->
        <div>
            <x-wireui-select
                wire:model.live="gender"
                label="Género"
                :options="[
                    ['label' => 'Masculino', 'value' => 'male'],
                    ['label' => 'Femenino', 'value' => 'female'],
                    ['label' => 'Otro', 'value' => 'other']
                ]"
                option-label="label"
                option-value="value"
            />
        </div>

        <!-- Estado Civil -->
        <div>
            <x-wireui-select
                wire:model.live="marital_status"
                label="Estado Civil"
                :options="[
                    ['label' => 'Soltero(a)', 'value' => 'single'],
                    ['label' => 'Casado(a)', 'value' => 'married'],
                    ['label' => 'Divorciado(a)', 'value' => 'divorced'],
                    ['label' => 'Viudo(a)', 'value' => 'widowed']
                ]"
                option-label="label"
                option-value="value"
            />
        </div>

        <!-- Nacionalidad -->
        <div>
            <x-wireui-select
                wire:model.live="nationality"
                label="Nacionalidad"
                :options="[
                    ['label' => 'Venezolano(a)', 'value' => 'venezolano'],
                    ['label' => 'Colombiano(a)', 'value' => 'colombiano'],
                    ['label' => 'Peruano(a)', 'value' => 'peruano'],
                    ['label' => 'Ecuatoriano(a)', 'value' => 'ecuatoriano'],
                    ['label' => 'Chileno(a)', 'value' => 'chileno'],
                    ['label' => 'Argentino(a)', 'value' => 'argentino'],
                    ['label' => 'Brasileño(a)', 'value' => 'brasileño'],
                    ['label' => 'Mexicano(a)', 'value' => 'mexicano'],
                    ['label' => 'Español(a)', 'value' => 'español'],
                    ['label' => 'Estadounidense', 'value' => 'estadounidense'],
                    ['label' => 'Otro', 'value' => 'otro']
                ]"
                option-label="label"
                option-value="value"
            />
        </div>  {{-- --}}
    </div>
</div>
