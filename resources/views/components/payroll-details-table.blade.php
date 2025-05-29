@props(['payrolls'])

<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-white dark:bg-gray-900">
            <tr>
                <th class="px-4 py-2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">Nombre</th>
                <th class="px-4 py-2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">Período</th>
                <th class="px-4 py-2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">Estado</th>
                <th class="px-4 py-2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">Moneda</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-900 dark:divide-gray-700">
            @forelse ($payrolls as $payroll)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                    <td class="px-4 py-2 text-sm text-gray-900 whitespace-nowrap dark:text-gray-100">
                        {{ $payroll->name }}
                    </td>
                    <td class="px-4 py-2 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                        @if($payroll->period_start && $payroll->period_end)
                            {{ $payroll->period_start->format('d/m/Y') }} - {{ $payroll->period_end->format('d/m/Y') }}
                        @else
                            <span class="italic text-gray-400 dark:text-gray-500">Período no definido</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                            bg-{{ $payroll->status['color'] }}-100 text-{{ $payroll->status['color'] }}-800">
                            {{ $payroll->status['label'] }}
                        </span>
                    </td>
                    <td class="px-4 py-2 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                        {{ $payroll->status_exchange ? 'USD' : 'Bs.' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-4 py-2 text-sm text-center text-gray-500 dark:text-gray-400">
                        Sin nóminas asociadas
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
