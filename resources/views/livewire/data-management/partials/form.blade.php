<form wire:submit="save">
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

    <!-- Información Laboral -->
    <div class="mb-8">
        <h2
            class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
            Información Laboral
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Fecha de Contratación -->
            <div>
                <label for="hire_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Fecha de Contratación
                </label>
                <input wire:model="worker.hire_date" type="date" id="hire_date"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                @error('worker.hire_date')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Salario Base -->
            <div>
                <label for="base_salary" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Salario Base
                </label>
                <input wire:model="worker.base_salary" type="number" step="0.01" id="base_salary"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                @error('worker.base_salary')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tipo de Contrato -->
            <div>
                <label for="contract_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Tipo de Contrato
                </label>
                <select wire:model="worker.contract_type" id="contract_type"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                    <option value="full-time">Tiempo Completo</option>
                    <option value="part-time">Tiempo Parcial</option>
                    <option value="temporary">Temporal</option>
                    <option value="contract">Por Contrato</option>
                </select>
                @error('worker.contract_type')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Estado -->
            <div class="flex items-center mt-6">
                <input wire:model="worker.is_active" type="checkbox" id="is_active"
                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="is_active" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                    Trabajador activo
                </label>
            </div>
        </div>
    </div>

    <!-- Información Financiera -->
    <div class="mb-8">
        <h2
            class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
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
                    <option value="bank_transfer">Transferencia Bancaria</option>
                    <option value="check">Cheque</option>
                    <option value="cash">Efectivo</option>
                </select>
                @error('worker.payment_method')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Banco -->
            <div x-data="{}" x-show="$wire.worker.payment_method === 'bank_transfer'">
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
            <div x-data="{}" x-show="$wire.worker.payment_method === 'bank_transfer'">
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
                <label for="tax_identification_number"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">
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
                <label for="social_security_number"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">
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

    <div class="mt-8 flex justify-end space-x-3">
        <a href="{{ route('workers.index') }}"
            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-md transition">
            Cancelar
        </a>
        <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition">
            {{ $isEdit ? 'Actualizar' : 'Registrar' }}
        </button>
    </div>
</form>
