@php
    $class['index'] = 'hidden sm:table-cell';
    $class['institution_name'] = '';
    $class['name'] = '';
    $class['latex'] = '';
    $class['description'] = 'max-w-md hidden xl:table-cell';
    $class['action'] = '';
    /* 'institution_name','name','latex','description', */
@endphp

{{-- <div class="mb-4 flex justify-between"> --}}
<div class="mb-4 flex justify-between flex-col gap-4 md:flex-row">
    <div class="w-full md:w-3/4">
        @php
            $name = 'search';
            $model = 'formulation.' . $name;
        @endphp
        <span wire:loading
            class="text-black font-semibold fixed	 bottom-0 right-0 z-10 bg-white rounded border shadow mr-2 mb-2 dark:text-gray-100">
            Cargando...
        </span>
        @php $label = "Institución, nombre, descripción" @endphp
        <x-input wire:model.debounce.500ms="{{ $name }}" icon="search" label="{{ $label }}"
            placeholder="{{ $label }}">

            <x-slot name="append">
                <div class="absolute inset-y-0 right-0 flex items-center p-0.5">
                    <x-button wire:click="cleanSearch()" class="h-full rounded-r-md" icon="x" flat squared />
                </div>
            </x-slot>

        </x-input>
    </div>
    <div class="w-full md:w-1/5">
        <x-select label="Registros por página" wire:model="paginate" placeholder="Páginas" :options="$paginate_list" />
    </div>
</div>

{{-- <x-errors /> --}}

<div class="overflow-x-auto">
    <table class="mb-4 table-auto w-full text-left whitespace-no-wrap">
        <thead>
            {{-- 'institution_name','name','latex','description' --}}

            <tr class="bg-gray-200 text-sm">
                @php $name = 'index' @endphp
                <th class="px-2 py-1 {{ $class[$name] ?? null }}">
                    ID
                </th>

                @php $name = 'institution_name' @endphp
                <th class="px-2 py-1 {{ $class[$name] ?? null }}">
                    <div class="flex justify-between">
                        <div>{{ $list_comment[$name] ?? '' }}</div>
                        @if ($formulations->isNotEmpty())
                            <div class="self-center">
                                <x-elements.crud.sort-by field="{{ $name }}" :sortBy="$sortBy"
                                    :sortDirection="$sortDirection" />
                            </div>
                        @endif
                    </div>
                </th>

                @php $name = 'name' @endphp
                <th class="px-2 py-1 {{ $class[$name] ?? null }}">
                    <div class="flex justify-between">
                        <div>{{ $list_comment[$name] ?? '' }}</div>
                        @if ($formulations->isNotEmpty())
                            <div class="self-center">
                                <x-elements.crud.sort-by field="{{ $name }}" :sortBy="$sortBy"
                                    :sortDirection="$sortDirection" />
                            </div>
                        @endif
                    </div>
                </th>

                @php $name = 'latex' @endphp
                <th class="w-auto px-2 py-1 {{ $class[$name] ?? null }}">
                    <div class="flex justify-between">
                        <div>{{ $list_comment[$name] ?? '' }}</div>
                        @if ($formulations->isNotEmpty())
                            <div class="self-center">
                                <x-elements.crud.sort-by field="{{ $name }}" :sortBy="$sortBy"
                                    :sortDirection="$sortDirection" />
                            </div>
                        @endif
                    </div>
                </th>

                @php $name = 'description' @endphp
                <th class="px-2 py-1 {{ $class[$name] ?? null }}">
                    <div class="flex justify-between">
                        <div>{{ $list_comment[$name] ?? '' }}</div>
                        @if ($formulations->isNotEmpty())
                            <div class="self-center">
                                <x-elements.crud.sort-by field="{{ $name }}" :sortBy="$sortBy"
                                    :sortDirection="$sortDirection" />
                            </div>
                        @endif
                    </div>
                </th>

                @php $name = 'action' @endphp
                <th class="px-2 py-1 {{ $class[$name] ?? null }}">
                    Acción
                </th>
            </tr>
        </thead>
        <tbody>
            {{-- 'institution_name','name','latex','description' --}}
            @forelse ($formulations as $item)
                <tr
                    class="border-t text-xs text-gray-600 border-gray-200 {{ $loop->iteration % 2 == 0 ? 'bg-gray-100' : 'bg-white' }}">
                    @php $name = 'index' @endphp
                    <td class="px-2 py-1 {{ $class[$name] ?? null }}">
                        {{ $loop->iteration }}
                    </td>

                    @php $name = 'institution_name' @endphp
                    <td class="px-2 py-1 {{ $class[$name] ?? null }}">
                        {{ $item->$name }}
                        {{-- <div class="ps-2">
                            @php @endphp
                            @foreach ($item->authorities as $authority)
                                <div class="text-xs text-gray-400">{{$loop->iteration}}. {{$authority->name}}</div>
                            @endforeach
                        </div> --}}
                    </td>

                    @php $name = 'name' @endphp
                    <td class="px-2 py-1 {{ $class[$name] ?? null }}">
                        {{ $item->$name }}
                    </td>

                    @php $name = 'latex' @endphp
                    <td class="px-2 py-1 {{ $class[$name] ?? null }}">
                        <math-field read-only class="{{ $loop->iteration % 2 == 0 ? 'bg-gray-100' : 'bg-white' }}">
                            {{ $item->$name ?? '' }}
                        </math-field>
                    </td>

                    @php $name = 'description' @endphp
                    <td class="px-2 py-1 {{ $class[$name] ?? null }}">
                        <span class="line-clamp-3">
                            {{ $item->$name }}
                        </span>
                    </td>

                    @php $name = 'action' @endphp
                    <td class="px-2 py-1 {{ $class[$name] ?? null }}">

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

    {{ $formulations->links() }}

</div>
