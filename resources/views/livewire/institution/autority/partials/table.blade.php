<div class="mb-4 flex justify-between">
    <div class="px-2 w-3/4">
        @php
            $name = 'search';
            $model = 'institution.' . $name;
        @endphp
        <span wire:loading
            class="text-black font-semibold fixed	 bottom-0 right-0 z-10 bg-white rounded border shadow mr-2 mb-2 dark:text-gray-100">
            Cargando...
        </span>
        @php $label = "Nombre, tipo, dirección o teléfono" @endphp
        <x-input wire:model.debounce.500ms="{{ $name }}" icon="search" label="{{ $label }}"
            placeholder="{{ $label }}">
            <x-slot name="append">
                <button class="absolute inset-y-0 right-0 flex items-center p-4 text-gray-600" wire:click="cleanSearch()">
                    <x-icon name="x" class="w-4 h-4" />
                </button>
            </x-slot>
        </x-input>
    </div>
    <div class="px-2 w-1/5">
        <x-select label="Registros por página" wire:model="paginate" placeholder="páginas" :options="$paginate_list" />
    </div>
</div>

<div class="overflow-x-auto">
    <table class="table-auto w-full text-left whitespace-no-wrap">
        <thead>
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">
                    <div class="flex justify-between">
                        @php $name = 'name' @endphp
                        <span>{{ $list_comment[$name] ?? '' }}</span>
                        @if ($authorities->isNotEmpty())
                            <x-elements.crud.sort-by field="{{ $name }}" :sortBy="$sortBy" :sortDirection="$sortDirection" />
                        @endif
                    </div>
                </th>
                <th class="px-4 py-2">
                    <div class="flex justify-between">
                        @php $name = 'position' @endphp
                        <span>{{ $list_comment[$name] ?? '' }}</span>
                        @if ($authorities->isNotEmpty())
                            <x-elements.crud.sort-by field="{{ $name }}" :sortBy="$sortBy" :sortDirection="$sortDirection" />
                        @endif
                    </div>
                </th>
                <th class="px-4 py-2">
                    <div class="flex justify-between">
                        @php $name = 'profile_professional' @endphp
                        <span>{{ $list_comment[$name] ?? '' }}</span>
                        @if ($authorities->isNotEmpty())
                            <x-elements.crud.sort-by field="{{ $name }}" :sortBy="$sortBy" :sortDirection="$sortDirection" />
                        @endif
                    </div>
                </th>
                <th class="px-4 py-2">
                    <div class="flex justify-between">
                        @php
                            $name = 'finicial';
                            $name2 = 'ffinal';
                        @endphp
                        <span>{{ $list_comment[$name] . ' - ' . $list_comment[$name2] ?? '' }}</span>
                    </div>
                </th>
                <th class="px-4 py-2">Acción</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($authorities as $item)
                <tr class="border-t border-gray-200">
                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2">{{ $item->name }}</td>
                    <td class="px-4 py-2">{{ $item->position }}</td>
                    <td class="px-4 py-2">{{ $item->profile_professional }}</td>
                    <td class="px-4 py-2">{{ $item->finicial }} - {{ $item->ffinal }}</td>
                    <td class="px-4 py-2">
                        <div class="flex gap-4">
                            <x-button.circle wire:click="edit({{ $item->id }})" primary icon="clipboard-list" />
                            <x-button.circle wire:click="deleteQuestion({{ $item->id }})" negative
                                icon="x" />
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
