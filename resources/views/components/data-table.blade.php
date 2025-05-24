@props([
    'headers' => [],
    'rows' => [],
    'sortable' => true,
    'sortField' => null,
    'sortDirection' => 'asc',
    'emptyMessage' => 'No hay registros disponibles.'
])

<div class="overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50 dark:bg-gray-800">
            <tr>
                @foreach($headers as $key => $header)
                    <th @if($sortable) wire:click="sortBy('{{ $key }}')" class="px-6 py-3 text-gray-600 cursor-pointer dark:text-gray-400" @else class="px-6 py-3 text-gray-600 dark:text-gray-400" @endif>
                        {{ $header }}
                        @if($sortable && $sortField === $key)
                            <span>{!! $sortDirection === 'asc' ? '&#8593;' : '&#8595;' !!}</span>
                        @endif
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse($rows as $row)
                <tr class="border-t border-gray-200 dark:border-gray-700">
                    {{ $row }}
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($headers) }}" class="px-6 py-4 text-center text-gray-500">
                        {{ $emptyMessage }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if(method_exists($rows, 'links'))
    <div class="mt-4">
        {{ $rows->links() }}
    </div>
@endif
