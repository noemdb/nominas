@php
    $class['index'] = 'hidden sm:table-cell';
    $class['name'] = '';
    // $class['institution_id'] = 'hidden md:table-cell';
    $class['level_id'] = 'hidden lg:table-cell';
    $class['frequency'] = 'hidden md:table-cell';
    $class['action'] = '';
@endphp
{{-- name,institution_id,level_id,frequency, --}}

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
        @php $label = "Institución, Nombre" @endphp
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

{{-- name,institution_id,level_id,frequency, --}}
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
                        @if ($payrolls->isNotEmpty())
                            <x-elements.crud.sort-by field="{{ $name }}" :sortBy="$sortBy" :sortDirection="$sortDirection" />
                        @endif
                    </div>
                </th>
                @php $name = 'level_id' @endphp
                <th class="px-2 py-1 {{ $class[$name] ?? null }}">
                    <div class="flex justify-between">
                        <span>{{ $list_comment[$name] ?? '' }}</span>
                        @if ($payrolls->isNotEmpty())
                            <x-elements.crud.sort-by field="{{ $name }}" :sortBy="$sortBy" :sortDirection="$sortDirection" />
                        @endif
                    </div>
                </th>
                @php $name = 'frequency' @endphp
                <th class="px-2 py-1 {{ $class[$name] ?? null }}">
                    <div class="flex justify-between">
                        <span>{{ $list_comment[$name] ?? '' }}</span>
                        @if ($payrolls->isNotEmpty())
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
            @forelse ($payrolls as $item)
                {{-- name,institution_id,level_id,frequency, --}}
                <tr class="border-t text-xs  border-gray-200 {{ $loop->iteration % 2 == 0 ? 'bg-gray-100' : 'bg-white' }} {{ $item->status ? 'text-gray-600' : 'text-red-400' }} ">

                    <td class="px-2 py-1 {{ $class['index'] ?? null }}">
                        {{ $loop->iteration }}
                    </td>

                    @php $name = 'name' @endphp
                    <td class="px-2 py-1 {{ $class[$name] ?? null }}">
                        {{ $item->{$name} }}
                        <div class="text-xs text-gray-400">{{ $item->institution->name ?? '' }}</div>
                    </td>

                    @php $name = 'level_id' @endphp
                    <td class="px-2 py-1 {{ $class[$name] ?? null }}">{{ $item->level->name }}</td>

                    @php $name = 'frequency' @endphp
                    <td class="px-2 py-1 {{ $class[$name] ?? null }}">{{ $item->{$name} }}</td>

                    <td class="px-2 py-1 {{ $class['action'] ?? null }}">
                        <div class="flex items-center space-x-end">
                            <x-button squared sm wire:click="show({{ $item->id }})" info icon="information-circle" class="px-4 rounded-l" />
                            <x-button squared sm wire:click="edit({{ $item->id }})" warning icon="pencil-alt" class="px-4" />
                            <x-button squared sm wire:click="deleteQuestion({{ $item->id }})" negative icon="x" class="px-4 rounded-r" />
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

    {{ $payrolls->links() }}

</div>
