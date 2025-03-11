{{ __('¡Bienvenido, Administrador de Nómina!') }}

<div class="mt-6">
    <!-- Título con icono mejorado -->
    <h3 class="text-lg font-semibold mb-4 flex items-center gap-2 text-gray-800 dark:text-gray-200">
        <!-- Icono de Configuración/Funcionalidades -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 012.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 011.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 01-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 01-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 01-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 01-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 011.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        <span>Funcionalidades:</span>
    </h3>

    <!-- Lista con iconos -->
    <ul class="space-y-4 pl-0">

        <!-- Registro y Actualización de Datos -->
        <li class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800">
            <div class="flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </div>
            <div>
                <strong class="block font-medium text-gray-800 dark:text-gray-200">Registro y Actualización de Datos</strong>
                <span class="text-sm text-gray-600 dark:text-gray-400">Administra la información de trabajadores, incluyendo altas, bajas y modificaciones de datos.</span>
            </div>
        </li>

        <!-- Beneficios Adicionales -->
        <li class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800">
            <div class="flex-shrink-0">
                <!-- Ícono de "Estrella" para beneficios destacados -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                </svg>
            </div>
            <div>
                <strong class="block font-medium text-gray-800 dark:text-gray-200">Beneficios Adicionales (Otras subvenciones)</strong>
                <span class="text-sm text-gray-600 dark:text-gray-400">
                    Gestiona beneficios complementarios como: Bonificaciones especiales, Ayudas para vivienda, subsidios para alimentación (diferentes al beneficio obligatorio de alimentación), apoyo para gastos educativos, compensaciones por uso de vehículo propio, Otras asignaciones especiales que mejoren las condiciones económicas del trabajador, etc.
                </span>
            </div>
        </li>

        <li class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800">
            <div class="flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.01 12.01 0 003 9c0 5.592 3.824 10.294 9 11.623 5.176-1.329 9-6.031 9-11.623 0-1.31-.21-2.571-.598-3.751" />
                </svg>
            </div>
            <div>
                <strong class="block font-medium text-gray-800 dark:text-gray-200">Prestaciones Legales Obligatorias</strong>
                <span class="text-sm text-gray-600 dark:text-gray-400">Gestiona prestaciones obligatorias según la LOTTT: salario mínimo, bono vacacional, utilidades, cestaticket, aportes al SSO, FAOV, INCES, y demás beneficios legales requeridos.</span>
            </div>
        </li>

        <!-- Deducciones -->
        <li class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800">
            <div class="flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <strong class="block font-medium text-gray-800 dark:text-gray-200">Deducciones y Descuentos</strong>
                <span class="text-sm text-gray-600 dark:text-gray-400">Administra retenciones obligatorias, préstamos y descuentos legales.</span>
            </div>
        </li>

        <!-- Gestión de Pagos -->
        <li class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800">
            <div class="flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <div>
                <strong class="block font-medium text-gray-800 dark:text-gray-200">Gestión de Pagos</strong>
                <span class="text-sm text-gray-600 dark:text-gray-400">Registra y gestiona pago de sueldos/salarios, bonos y otros conceptos.</span>
            </div>
        </li>        

        <!-- Vacaciones -->
        <li class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800">
            <div class="flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <strong class="block font-medium text-gray-800 dark:text-gray-200">Control de Vacaciones</strong>
                <span class="text-sm text-gray-600 dark:text-gray-400">Gestiona solicitudes y días disponibles.</span>
            </div>
        </li>

        <!-- Reportes -->
        <li class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800">
            <div class="flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9m0 10h6m-6 0h6m6-10h-6m0 0a2 2 0 012 2v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6a2 2 0 012-2h6z" />
                </svg>
            </div>
            <div>
                <strong class="block font-medium text-gray-800 dark:text-gray-200">Reportes y Estadísticas</strong>
                <span class="text-sm text-gray-600 dark:text-gray-400">Genera reportes financieros detallados.</span>
            </div>
        </li>

        <!-- Configuración -->
        <li class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800">
            <div class="flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <div>
                <strong class="block font-medium text-gray-800 dark:text-gray-200">Configuración del Sistema</strong>
                <span class="text-sm text-gray-600 dark:text-gray-400">Personaliza parámetros y políticas.</span>
            </div>
        </li>
    </ul>
</div>

<div class="mt-8">
    <p class="text-sm text-gray-600 dark:text-gray-400">
        Utiliza el menú de navegación para acceder a las diferentes secciones y gestionar la nómina de manera eficiente.
    </p>
</div>