<div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
    <!-- Active Workers Card -->
    <div class="overflow-hidden bg-white rounded-lg shadow-sm dark:bg-gray-800">
        <div class="p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 bg-blue-500 rounded-md">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div class="flex-1 w-0 ml-5">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate dark:text-gray-400">
                            Trabajadores Activos
                        </dt>
                        <dd class="flex items-baseline">
                            <div class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
                                {{ $indicators['active_workers'] }}
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Payrolls Card -->
    <div class="overflow-hidden bg-white rounded-lg shadow-sm dark:bg-gray-800">
        <div class="p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 bg-green-500 rounded-md">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div class="flex-1 w-0 ml-5">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate dark:text-gray-400">
                            Total Nóminas
                        </dt>
                        <dd class="flex items-baseline">
                            <div class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
                                {{ $indicators['total_payrolls'] }}
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- Approved Payrolls Card -->
    <div class="overflow-hidden bg-white rounded-lg shadow-sm dark:bg-gray-800">
        <div class="p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 bg-teal-500 rounded-md">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="flex-1 w-0 ml-5">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate dark:text-gray-400">
                            Nóminas Aprobadas
                        </dt>
                        <dd class="flex items-baseline">
                            <div class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
                                {{ $indicators['approved_payrolls'] }}
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Payrolls Card -->
    <div class="overflow-hidden bg-white rounded-lg shadow-sm dark:bg-gray-800">
        <div class="p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 bg-yellow-500 rounded-md">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="flex-1 w-0 ml-5">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate dark:text-gray-400">
                            Nóminas Pendientes
                        </dt>
                        <dd class="flex items-baseline">
                            <div class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
                                {{ $indicators['pending_payrolls'] }}
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Amount Paid Card -->
    <div class="overflow-hidden bg-white rounded-lg shadow-sm dark:bg-gray-800">
        <div class="p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 bg-purple-500 rounded-md">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="flex-1 w-0 ml-5">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate dark:text-gray-400">
                            Monto Total Pagado
                        </dt>
                        <dd class="flex items-baseline">
                            <div class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
                                Bs {{ number_format($indicators['total_amount_paid'], 2) }}
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Deductions Card -->
    <div class="overflow-hidden bg-white rounded-lg shadow-sm dark:bg-gray-800">
        <div class="p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 bg-red-500 rounded-md">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="flex-1 w-0 ml-5">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate dark:text-gray-400">
                            Total Deducciones
                        </dt>
                        <dd class="flex items-baseline">
                            <div class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
                                Bs. {{ number_format($indicators['total_deductions'], 2) }}
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    @if($indicators['current_payroll'] && $indicators['payroll_summary'])
    <!-- Current Payroll Summary Card -->
    <div class="col-span-1 overflow-hidden bg-white rounded-lg shadow-sm dark:bg-gray-800 md:col-span-2 lg:col-span-3">
        <div class="p-6">
            <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-gray-100">
                Resumen de Nómina Actual: {{ $indicators['current_payroll']->name }}
            </h3>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
                <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-700">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Trabajadores</p>
                    <p class="text-xl font-semibold text-gray-900 dark:text-gray-100">
                        {{ $indicators['payroll_summary']['total_workers'] }}
                    </p>
                </div>
                <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-700">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Asignaciones</p>
                    <p class="text-xl font-semibold text-gray-900 dark:text-gray-100">
                        Bs {{ number_format($indicators['payroll_summary']['total_assignments'], 2) }}
                    </p>
                </div>
                <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-700">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Deducciones</p>
                    <p class="text-xl font-semibold text-red-600 dark:text-red-400">
                        Bs {{ number_format($indicators['payroll_summary']['total_deductions'], 2) }}
                    </p>
                </div>
                <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-700">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Neto a Pagar</p>
                    <p class="text-xl font-semibold text-gray-900 dark:text-gray-100">
                        Bs {{ number_format($indicators['payroll_summary']['total_net_pay'], 2) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
