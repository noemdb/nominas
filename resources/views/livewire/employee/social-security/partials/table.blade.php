@php
    $class['index'] = 'hidden sm:table-cell';
    $class['employee_name'] = '';
    $class['number'] = 'hidden sm:table-cell';
    $class['card_number'] = 'hidden md:table-cell';
    $class['card_issue_date'] = 'hidden lg:table-cell';
    $class['action'] = '';
@endphp

{{-- employee_name, number,card_number,card_issue_date --}}

<div class="mb-4 flex justify-between flex-col gap-4 md:flex-row">
    <div class="w-full md:w-3/4">
        @php
            $name = 'search';
            $model = 'social_securities.' . $name;
        @endphp
        <span wire:loading
            class="text-black font-semibold fixed	 bottom-0 right-0 z-10 bg-white rounded border shadow mr-2 mb-2 dark:text-gray-100">
            Cargando...
        </span>
        @php $label = "Nombre, cédula de identidad, empleador, cargo" @endphp
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
            {{-- employee_name, number,card_number,card_issue_date --}}
            <tr class="bg-gray-200 text-sm">
                <th class="px-2 py-1 {{ $class['index'] ?? null }}">
                    ID
                </th>
                @php $name = 'employee_name' @endphp
                <th class="px-2 py-1 {{ $class[$name] ?? null }}">
                    <div class="flex justify-between">
                        <span>{{ $list_comment[$name] ?? '' }}</span>
                        @if ($social_securities->isNotEmpty())
                            <x-elements.crud.sort-by field="{{ $name }}" :sortBy="$sortBy" :sortDirection="$sortDirection" />
                        @endif
                    </div>
                </th>
                @php $name = 'number' @endphp
                <th class="px-2 py-1 {{ $class[$name] ?? null }}">
                    <div class="flex justify-between">
                        <span>{{ $list_comment[$name] ?? '' }}</span>
                        @if ($social_securities->isNotEmpty())
                            <x-elements.crud.sort-by field="{{ $name }}" :sortBy="$sortBy" :sortDirection="$sortDirection" />
                        @endif
                    </div>
                </th>
                @php $name = 'card_number' @endphp
                <th class="px-2 py-1 {{ $class[$name] ?? null }}">
                    <div class="flex justify-between">
                        <span>{{ $list_comment[$name] ?? '' }}</span>
                        @if ($social_securities->isNotEmpty())
                            <x-elements.crud.sort-by field="{{ $name }}" :sortBy="$sortBy" :sortDirection="$sortDirection" />
                        @endif
                    </div>
                </th>
                @php $name = 'card_issue_date' @endphp
                <th class="px-2 py-1 {{ $class[$name] ?? null }}">
                    <div class="flex justify-between">
                        <span>{{ $list_comment[$name] ?? '' }}</span>
                        @if ($social_securities->isNotEmpty())
                            <x-elements.crud.sort-by field="{{ $name }}" :sortBy="$sortBy" :sortDirection="$sortDirection" />
                        @endif
                    </div>
                </th>
                <th class="px-2 py-1 {{ $class['action'] ?? null }}">
                    Acción
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($social_securities as $item)
                {{-- employee_name, number,card_number,card_issue_date --}}
                <tr
                    class="border-t text-xs text-gray-600 border-gray-200 {{ $loop->iteration % 2 == 0 ? 'bg-gray-100' : 'bg-white' }}">
                    <td class="px-2 py-1 {{ $class['index'] ?? null }}">
                        {{ $loop->iteration }}
                    </td>
                    @php $name = 'employee_name'; $employee = $item->employee @endphp
                    <td class="px-2 py-1 flex flex-col {{ $class[$name] ?? null }}">
                        <span> {{$item->$name}}</span>
                        <span class="text-xs text-gray-400">{{$employee->ci}}</span>
                    </td>
                    @php $name = 'number' @endphp
                    <td class="px-2 py-1 flex flex-col {{ $class[$name] ?? null }}">
                        <span> {{$item->$name}}</span>
                    </td>
                    @php $name = 'card_number' @endphp
                    <td class="px-2 py-1 flex flex-col {{ $class[$name] ?? null }}">
                        <span> {{$item->$name}}</span>
                    </td>
                    @php $name = 'card_issue_date' @endphp
                    <td class="px-2 py-1 flex flex-col {{ $class[$name] ?? null }}">
                        <span> {{$item->$name}}</span>
                    </td>
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

    {{ $social_securities->links() }}

</div>
