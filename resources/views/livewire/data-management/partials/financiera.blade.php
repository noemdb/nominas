<!-- Información Financiera -->
<div class="mb-8">
    <h2
        class="mb-1 text-gray-800 border-b border-gray-200 text-end font-extralight text-md dark:text-gray-400 dark:border-gray-700">
        Información Financiera y Fiscal
    </h2>
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        <!-- Método de Pago -->
        <div>

            {{-- Debug: {{$payment_method}} --}}

            <x-wireui-select
                wire:model.live="payment_method"
                label="Método de pago" placeholder="Seleccione un método de pago"
                :options="[
                    ['name' => 'Transferencia Bancaria', 'value' => 'bank_transfer'],
                    ['name' => 'Efectivo', 'value' => 'cash'],
                    ['name' => 'Cheque', 'value' => 'check'],
                ]" option-label="name" option-value="value"
            />
        </div>

        <!-- Banco -->
        <div x-data="{}" x-show="$wire.payment_method === 'bank_transfer'">
            <x-wireui-input
                label="Banco"
                placeholder="Ingrese el nombre del banco"
                wire:model="bank_name"
            />
        </div>

        <!-- Número de Cuenta -->
        <div x-data="{}" x-show="$wire.payment_method === 'bank_transfer'">
            <x-wireui-input
                label="Número de Cuenta"
                placeholder="Ingrese el número de cuenta"
                wire:model="bank_account_number"
            />
        </div>

        <!-- Número de Identificación Fiscal -->
        <div>
            <x-wireui-input
                label="RIF"
                placeholder="Ingrese el RIF"
                wire:model="tax_identification_number"
            />
        </div>

        <!-- Número de Seguridad Social -->
        <div>
            <x-wireui-input
                label="N. Seguridad Social"
                placeholder="Ingrese el número de seguridad social"
                wire:model="social_security_number"
            />
        </div>

        <!-- Fondo de Pensiones -->
        <div>
            <x-wireui-input
                label="Fondo de Pensiones"
                placeholder="Ingrese el fondo de pensiones"
                wire:model="pension_fund"
            />
        </div>
    </div>
</div>
