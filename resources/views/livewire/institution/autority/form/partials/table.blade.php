@php
    $class['index'] = 'hidden sm:table-cell';
    $class['name'] = '';
    $class['position'] = 'hidden md:table-cell';
    $class['profile_professional'] = 'hidden lg:table-cell';
    $class['dates'] = 'hidden md:table-cell';
    $class['action'] = '';
@endphp

<div class="mb-4 flex justify-between flex-col gap-4 md:flex-row">
    <div class="w-full md:w-3/4">
        @php
            $name = 'search';
            $model = 'authority.' . $name;
        @endphp
        <span wire:loading
            class="text-black font-semibold fixed	 bottom-0 right-0 z-10 bg-white rounded border shadow mr-2 mb-2 dark:text-gray-100">
            Cargando...
        </span>
        @php $label = "Nombre, CI, cargo, perfil profesional" @endphp
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
                <th class="px-2 py-1 {{ $class['name'] ?? null }}">
                    <div class="flex justify-between">
                        @php $name = 'name' @endphp
                        <span>{{ $list_comment[$name] ?? '' }}</span>
                        @if ($authorities->isNotEmpty())
                            <x-elements.crud.sort-by field="{{ $name }}" :sortBy="$sortBy" :sortDirection="$sortDirection" />
                        @endif
                    </div>
                </th>
                <th class="px-2 py-1 {{ $class['position'] ?? null }}">
                    <div class="flex justify-between">
                        @php $name = 'position' @endphp
                        <span>{{ $list_comment[$name] ?? '' }}</span>
                        @if ($authorities->isNotEmpty())
                            <x-elements.crud.sort-by field="{{ $name }}" :sortBy="$sortBy" :sortDirection="$sortDirection" />
                        @endif
                    </div>
                </th>
                <th class="px-2 py-1 {{ $class['profile_professional'] ?? null }}">
                    <div class="flex justify-between">
                        @php $name = 'profile_professional' @endphp
                        <span>{{ $list_comment[$name] ?? '' }}</span>
                        @if ($authorities->isNotEmpty())
                            <x-elements.crud.sort-by field="{{ $name }}" :sortBy="$sortBy" :sortDirection="$sortDirection" />
                        @endif
                    </div>
                </th>
                <th class="px-2 py-1 {{ $class['dates'] ?? null }}">
                    <div class="flex justify-between">
                        @php
                            $name = 'finicial';
                            $name2 = 'ffinal';
                        @endphp
                        <span>{{ $list_comment[$name] . ' - ' . $list_comment[$name2] ?? '' }}</span>
                    </div>
                </th>
                <th class="px-2 py-1 {{ $class['action'] ?? null }}">
                    Acción
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($authorities as $item)
                <tr
                    class="border-t text-xs text-gray-600 border-gray-200 {{ $loop->iteration % 2 == 0 ? 'bg-gray-100' : 'bg-white' }}">
                    <td class="px-2 py-1 {{ $class['index'] ?? null }}">
                        {{ $loop->iteration }}
                    </td>
                    <td class="px-2 py-1 {{ $class['name'] ?? null }}">
                        {{ $item->name }}
                        <div>{{$item->ci}}</div>
                        <div>
                            <span class="text-xs text-gray-400">{{ $item->institution->name ?? '' }}</span>
                        </div>
                    </td>
                    <td class="px-2 py-1 {{ $class['position'] ?? null }}">{{ $item->position }}</td>
                    <td class="px-2 py-1 {{ $class['profile_professional'] ?? null }}">
                        {{ $item->profile_professional }}
                    </td>
                    <td class="px-2 py-1 {{ $class['dates'] ?? null }}">
                        {{ $item->finicial->format('d-m-Y') }} - {{ $item->ffinal->format('d-m-Y') }}
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

    {{ $authorities->links() }}

</div>
