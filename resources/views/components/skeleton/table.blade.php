@props(['rows' => 5])

<div class="animate-pulse">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th class="px-6 py-3 text-gray-600 dark:text-gray-400">Fecha</th>
                    <th class="px-6 py-3 text-gray-600 dark:text-gray-400">Trabajador</th>
                    <th class="px-6 py-3 text-gray-600 dark:text-gray-400">Asistencia</th>
                    <th class="px-6 py-3 text-gray-600 dark:text-gray-400">Faltas</th>
                    <th class="px-6 py-3 text-gray-600 dark:text-gray-400">Permisos</th>
                    <th class="px-6 py-3 text-gray-600 dark:text-gray-400">Retardos</th>
                    <th class="px-6 py-3 text-gray-600 dark:text-gray-400">Bono/Descuento</th>
                    <th class="px-6 py-3 text-gray-600 dark:text-gray-400">Estado</th>
                    <th class="px-6 py-3 text-gray-600 dark:text-gray-400">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < $rows; $i++)
                    <tr class="border-t border-gray-200 dark:border-gray-700">
                        <td class="px-6 py-4">
                            <div class="w-24 h-4 bg-gray-200 rounded dark:bg-gray-700"></div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="w-32 h-4 bg-gray-200 rounded dark:bg-gray-700"></div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="w-16 h-4 bg-gray-200 rounded dark:bg-gray-700"></div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="w-12 h-4 bg-gray-200 rounded dark:bg-gray-700"></div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="w-12 h-4 bg-gray-200 rounded dark:bg-gray-700"></div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="w-12 h-4 bg-gray-200 rounded dark:bg-gray-700"></div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="w-20 h-4 bg-gray-200 rounded dark:bg-gray-700"></div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="w-16 h-4 bg-gray-200 rounded dark:bg-gray-700"></div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <div class="w-8 h-8 bg-gray-200 rounded dark:bg-gray-700"></div>
                                <div class="w-8 h-8 bg-gray-200 rounded dark:bg-gray-700"></div>
                            </div>
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>
