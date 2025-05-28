<!-- Modal para calcular nómina -->
<x-modal
    title="Calcular Nómina"
    :max-width="'2xl'"
    wire:key="modal-calculate-{{ $payrollId }}">

    <div class="space-y-6">
        <!-- Información de la Nómina -->
        <div class="space-y-4">
            <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">Información de la Nómina</h3>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Nombre:</span>
                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $payrollName }}</p>
                </div>
                <div>
                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Período:</span>
                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                        {{ \Carbon\Carbon::parse($dateStart)->format('d/m/Y') }} -
                        {{ \Carbon\Carbon::parse($dateEnd)->format('d/m/Y') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Contenido de Ejemplo -->
        <div class="space-y-4">
            <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">Proceso de Cálculo</h3>
            <div class="prose dark:prose-invert max-w-none">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800">
                    <h4 class="mb-2 text-sm font-medium text-gray-900 dark:text-gray-100">Pasos del Proceso:</h4>
                    <ol class="space-y-2 text-sm text-gray-600 list-decimal list-inside dark:text-gray-400">
                        <li>Verificación de datos de trabajadores</li>
                        <li>Cálculo de días laborables</li>
                        <li>Aplicación de bonificaciones</li>
                        <li>Cálculo de descuentos</li>
                        <li>Generación de reportes</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Opciones de Cálculo -->
        <div class="space-y-4">
            <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">Opciones de Cálculo</h3>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <x-wireui-toggle
                        wire:model="recalculate"
                        label="Recalcular todo"
                        description="Forzar el recálculo de todos los conceptos"
                    />
                </div>
                <div>
                    <x-wireui-toggle
                        wire:model="generateReports"
                        label="Generar reportes"
                        description="Crear reportes automáticamente al finalizar"
                    />
                </div>
            </div>
        </div>

        <x-wireui-errors />

        <!-- Botones -->
        <div class="flex justify-end mt-8 space-x-3">
            <x-wireui-button white label="Cancelar" wire:click="closeCalculateModal" onclick="event.preventDefault();"/>
            <x-wireui-button
                primary
                label="Iniciar Cálculo"
                wire:click="startCalculation"
                wire:loading.attr="disabled"
                wire:target="startCalculation" />
        </div>
    </div>
</x-modal>
