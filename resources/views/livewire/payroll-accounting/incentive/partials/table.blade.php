@php
    $class['index'] = 'hidden sm:table-cell';
    $class['type'] = '';
    $class['employee_name'] = '';
    $class['description'] = 'max-w-md hidden lg:table-cell';
    $class['amount'] = '';
    $class['frequency'] = '';
    $class['date'] = 'w-auto';
@endphp

<div class="mb-4 flex justify-between flex-col gap-4 md:flex-row">
    <div class="w-full md:w-3/4">
        @php
            $name = 'search';
            $model = 'area.' . $name;
        @endphp
        <span wire:loading
            class="text-black font-semibold fixed	 bottom-0 right-0 z-10 bg-white rounded border shadow mr-2 mb-2 dark:text-gray-100">
            Cargando...
        </span>
        @php $label = "Nombre o descripción" @endphp
        <x-input wire:model.debounce.500ms="{{ $name }}" icon="search" label="{{ $label }}"
            placeholder="{{ $label }}">
            <x-slot name="append">
                <button class="absolute inset-y-0 right-0 flex items-center p-4 text-gray-600" wire:click="cleanSearch()">
                    <x-icon name="x" class="w-4 h-4" />
                </button>
            </x-slot>
        </x-input>
    </div>
    <div class="w-full md:w-1/5">
        <x-select label="Registros por página" wire:model="paginate" placeholder="Páginas" :options="$paginate_list" />
    </div>
</div>

<div class="overflow-x-auto">
    <table class="mb-4 table-auto w-full text-left whitespace-no-wrap">
        <thead>
            <tr class="bg-gray-200 text-sm">
                <th class="px-2 py-1 {{ $class['index'] ?? null }}">
                    ID
                </th>
                <th class="px-2 py-1 {{ $class['employee_name'] ?? null }}">
                    <div class="flex justify-between">
                        @php $name = 'employee_name' @endphp
                        <span>{{ $list_comment[$name] ?? '' }}</span>
                        @if ($incentives->isNotEmpty())
                            <x-elements.crud.sort-by field="{{ $name }}" :sortBy="$sortBy" :sortDirection="$sortDirection" />
                        @endif
                    </div>
                </th>
                <th class="px-2 py-1 {{ $class['type'] ?? null }}">
                    <div class="flex justify-between">
                        @php $name = 'type' @endphp
                        <span>{{ $list_comment[$name] ?? '' }}</span>
                        @if ($incentives->isNotEmpty())
                            <x-elements.crud.sort-by field="{{ $name }}" :sortBy="$sortBy" :sortDirection="$sortDirection" />
                        @endif
                    </div>
                </th>
                <th class="px-2 py-1 {{ $class['description'] ?? null }}">
                    <div class="flex justify-between">
                        @php $name = 'description' @endphp
                        <span>{{ $list_comment[$name] ?? '' }}</span>
                        @if ($incentives->isNotEmpty())
                            <x-elements.crud.sort-by field="{{ $name }}" :sortBy="$sortBy" :sortDirection="$sortDirection" />
                        @endif
                    </div>
                </th>
                <th class="px-2 py-1 {{ $class['amount'] ?? null }}">
                    <div class="flex justify-between">
                        @php $name = 'amount' @endphp
                        <span>{{ $list_comment[$name] ?? '' }}</span>
                        @if ($incentives->isNotEmpty())
                            <x-elements.crud.sort-by field="{{ $name }}" :sortBy="$sortBy" :sortDirection="$sortDirection" />
                        @endif
                    </div>
                </th>
                <th class="px-2 py-1 {{ $class['frequency'] ?? null }}">
                    <div class="flex justify-between">
                        @php $name = 'frequency' @endphp
                        <span>{{ $list_comment[$name] ?? '' }}</span>
                        @if ($incentives->isNotEmpty())
                            <x-elements.crud.sort-by field="{{ $name }}" :sortBy="$sortBy"
                                :sortDirection="$sortDirection" />
                        @endif
                    </div>
                </th>
                <th class="px-2 py-1 {{ $class['date'] ?? null }}">
                    <div class="flex justify-between">
                        @php $name = 'date' @endphp
                        <span>{{ $list_comment[$name] ?? '' }}</span>
                        @if ($incentives->isNotEmpty())
                            <x-elements.crud.sort-by field="{{ $name }}" :sortBy="$sortBy"
                                :sortDirection="$sortDirection" />
                        @endif
                    </div>
                </th>
                <th class="px-2 py-1 {{ $class['action'] ?? null }}">
                    Acción
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($incentives as $item)
                <tr
                    class="border-t text-xs text-gray-600 border-gray-200 {{ $loop->iteration % 2 == 0 ? 'bg-gray-100' : 'bg-white' }}">
                    <td class="px-2 py-1 {{ $class['index'] ?? null }}">
                        {{ $loop->iteration }}
                    </td>
                    <td class="px-2 py-1 {{ $class['employee_name'] ?? null }}">{{ $item->employee->name }}</td>
                    <td class="px-2 py-1 {{ $class['type'] ?? null }}">{{ $item->type }}</td>
                    <td class="px-2 py-1 {{ $class['description'] ?? null }}">
                        <span class="line-clamp-2">{{ $item->description }}</span>
                    </td>
                    <td class="px-2 py-1 {{ $class['amount'] ?? null }}">{{ $item->amount }}</td>
                    <td class="px-2 py-1 {{ $class['frequency'] ?? null }}">{{ $item->frequency }}</td>
                    <td class="px-2 py-1 {{ $class['date'] ?? null }}">{{ $item->date }}</td>
                    <td class="px-2 py-1 {{ $class['action'] ?? null }}">
                        <div class="flex items-center space-x-end">
                            <x-button squared sm wire:click="show({{ $item->id }})" info icon="information-circle"
                                class="px-4 rounded-l" />
                            <x-button squared sm wire:click="edit({{ $item->id }})" warning icon="pencil-alt"
                                class="px-4" />
                            <x-button squared sm wire:click="deleteQuestion({{ $item->id }})" negative
                                icon="x" class="px-4 rounded-r" />
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">
                        No hay datos
                    </td>
                </tr>
            @endforelse

        </tbody>
    </table>

    {{ $incentives->links() }}

</div>
