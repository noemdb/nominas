<!-- Información Financiera -->
<div class="mb-8">
    <h2
        class="text-end font-extralight text-md text-gray-800 dark:text-gray-400 mb-1 border-b border-gray-200 dark:border-gray-700">
        Información Financiera y Fiscal
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Método de Pago -->
        <div>
            <label for="payment_method" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Método de Pago
            </label>
            <select wire:model="worker.payment_method" id="payment_method"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                <option selected>Seleccione</option>
                <option value="Transferencia Bancaria">Transferencia Bancaria</option>
                <option value="Cheque">Cheque</option>
                <option value="Efectivo">Efectivo</option>
            </select>
            @error('worker.payment_method')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Banco -->
        <div x-data="{}" x-show="$wire.worker.payment_method === 'Transferencia Bancaria'">
            <label for="bank_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Banco
            </label>
            <input wire:model="worker.bank_name" type="text" id="bank_name"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
            @error('worker.bank_name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Número de Cuenta -->
        <div x-data="{}" x-show="$wire.worker.payment_method === 'Transferencia Bancaria'">
            <label for="bank_account_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Número de Cuenta
            </label>
            <input wire:model="worker.bank_account_number" type="text" id="bank_account_number"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
            @error('worker.bank_account_number')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Número de Identificación Fiscal -->
        <div>
            <label for="tax_identification_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                RIF
            </label>
            <input wire:model="worker.tax_identification_number" type="text" id="tax_identification_number"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
            @error('worker.tax_identification_number')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Número de Seguridad Social -->
        <div>
            <label for="social_security_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                N. Seguridad Social
            </label>
            <input wire:model="worker.social_security_number" type="text" id="social_security_number"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
            @error('worker.social_security_number')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Fondo de Pensiones -->
        <div>
            <label for="pension_fund" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Fondo de Pensiones
            </label>
            <input wire:model="worker.pension_fund" type="text" id="pension_fund"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
            @error('worker.pension_fund')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
