@php
    $class['index'] = 'hidden sm:table-cell';
    $class['start_time'] = '';
    $class['end_time'] = '';
    $class['schedule_type'] = 'hidden md:table-cell';
    $class['weekday'] = 'hidden lg:table-cell';
@endphp

<div class="mb-4 flex justify-between flex-col gap-4 md:flex-row">
    <div class="w-full md:w-3/4">
        @php
            $name = 'search';
            $model = 'schedule.' . $name;
        @endphp
        <span wire:loading
            class="text-black font-semibold fixed	 bottom-0 right-0 z-10 bg-white rounded border shadow mr-2 mb-2 dark:text-gray-100">
            Cargando...
        </span>
        @php $label = "Hora de inicio, hora de finalización, tipo de horario, día de la semana" @endphp
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
                <th class="px-2 py-1 {{ $class['start_time'] ?? null }}">
                    <div class="flex justify-between">
                        @php $name = 'start_time' @endphp
                        <span>{{ $list_comment[$name] ?? '' }}</span>
                        @if ($schedules->isNotEmpty())
                            <x-elements.crud.sort-by field="{{ $name }}" :sortBy="$sortBy" :sortDirection="$sortDirection" />
                        @endif
                    </div>
                </th>
                <th class="px-2 py-1 {{ $class['end_time'] ?? null }}">
                    <div class="flex justify-between">
                        @php $name = 'end_time' @endphp
                        <span>{{ $list_comment[$name] ?? '' }}</span>
                        @if ($schedules->isNotEmpty())
                            <x-elements.crud.sort-by field="{{ $name }}" :sortBy="$sortBy" :sortDirection="$sortDirection" />
                        @endif
                    </div>
                </th>
                <th class="px-2 py-1 {{ $class['schedule_type'] ?? null }}">
                    <div class="flex justify-between">
                        @php $name = 'schedule_type' @endphp
                        <span>{{ $list_comment[$name] ?? '' }}</span>
                        @if ($schedules->isNotEmpty())
                            <x-elements.crud.sort-by field="{{ $name }}" :sortBy="$sortBy" :sortDirection="$sortDirection" />
                        @endif
                    </div>
                </th>
                <th class="px-2 py-1 {{ $class['weekday'] ?? null }}">
                    <div class="flex justify-between">
                        @php $name = 'weekday' @endphp
                        <span>{{ $list_comment[$name] ?? '' }}</span>
                        @if ($schedules->isNotEmpty())
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
            @forelse ($schedules as $item)
                <tr
                    class="border-t text-xs text-gray-600 border-gray-200 {{ $loop->iteration % 2 == 0 ? 'bg-gray-100' : 'bg-white' }}">
                    <td class="px-2 py-1 {{ $class['index'] ?? null }}">
                        {{ $loop->iteration }}
                    </td>
                    <td class="px-2 py-1 {{ $class['start_time'] ?? null }}">{{ $item->start_time }}</td>
                    <td class="px-2 py-1 {{ $class['end_time'] ?? null }}">{{ $item->end_time }}</td>
                    <td class="px-2 py-1 {{ $class['schedule_type'] ?? null }}">{{ $item->schedule_type }}</td>
                    <td class="px-2 py-1 {{ $class['weekday'] ?? null }}">
                        {{ $item->weekday }}
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

    {{ $schedules->links() }}

</div>
