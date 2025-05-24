@props(['rows' => 5])

<div class="overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50 dark:bg-gray-800">
            <tr>
                <th class="hidden px-6 py-3 text-gray-600 dark:text-gray-400 sm:table-cell">
                    <div class="h-4 bg-gray-200 rounded dark:bg-gray-700 animate-pulse"></div>
                </th>
                <th class="hidden px-6 py-3 sm:table-cell">
                    <div class="h-4 bg-gray-200 rounded dark:bg-gray-700 animate-pulse"></div>
                </th>
                <th class="hidden px-6 py-3 sm:table-cell">
                    <div class="h-4 bg-gray-200 rounded dark:bg-gray-700 animate-pulse"></div>
                </th>
                <th class="hidden px-6 py-3 sm:table-cell">
                    <div class="h-4 bg-gray-200 rounded dark:bg-gray-700 animate-pulse"></div>
                </th>
                <th class="hidden px-6 py-3 sm:table-cell">
                    <div class="h-4 bg-gray-200 rounded dark:bg-gray-700 animate-pulse"></div>
                </th>
                <th class="hidden px-6 py-3 sm:table-cell">
                    <div class="h-4 bg-gray-200 rounded dark:bg-gray-700 animate-pulse"></div>
                </th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < $rows; $i++)
                <tr class="border-t border-gray-200 dark:border-gray-700">
                    <td class="block px-6 py-4 sm:table-cell">
                        <div class="h-4 bg-gray-200 rounded dark:bg-gray-700 animate-pulse"></div>
                    </td>
                    <td class="block px-6 py-4 sm:table-cell">
                        <div class="h-4 bg-gray-200 rounded dark:bg-gray-700 animate-pulse"></div>
                    </td>
                    <td class="block px-6 py-4 sm:table-cell">
                        <div class="h-4 bg-gray-200 rounded dark:bg-gray-700 animate-pulse"></div>
                    </td>
                    <td class="block px-6 py-4 sm:table-cell">
                        <div class="h-4 bg-gray-200 rounded dark:bg-gray-700 animate-pulse"></div>
                    </td>
                    <td class="block px-6 py-4 sm:table-cell">
                        <div class="h-4 bg-gray-200 rounded dark:bg-gray-700 animate-pulse"></div>
                    </td>
                    <td class="block px-6 py-4 sm:table-cell">
                        <div class="flex space-x-2">
                            <div class="w-8 h-8 bg-gray-200 rounded dark:bg-gray-700 animate-pulse"></div>
                            <div class="w-8 h-8 bg-gray-200 rounded dark:bg-gray-700 animate-pulse"></div>
                            <div class="w-8 h-8 bg-gray-200 rounded dark:bg-gray-700 animate-pulse"></div>
                        </div>
                    </td>
                </tr>
            @endfor
        </tbody>
    </table>
</div>