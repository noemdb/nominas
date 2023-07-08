@php
    $class['index'] = 'hidden sm:table-cell';
    $class['employee_id'] = '';
    $class['currency_id'] = '';
    $class['date'] = 'hidden md:table-cell';
    $class['amount'] = 'hidden lg:table-cell';
    $class['payment_status'] = 'hidden lg:table-cell';
    $class['action'] = '';
@endphp
{{-- 'employee_id','currency_id','date','amount','payment_status' --}}

<div class="mb-4 flex justify-between flex-col gap-4 md:flex-row">
    <div class="w-full md:w-3/4">
        @php
            $name = 'search';
            $model = 'bank.' . $name;
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

<div class="overflow-x-auto">
    <table class="table-auto w-full text-left whitespace-no-wrap my-1">
        <thead>
            {{-- 'employee_id','currency_id','date','amount','payment_status' --}}

            <tr class="bg-gray-200 text-sm">
                @php $name = 'index' @endphp
                <th class="px-2 py-1 {{$class[$name] ?? null}}">
                    ID
                </th>

                @php $name = 'employee_id' @endphp
                <th class="px-2 py-1 {{$class[$name] ?? null}}">
                    <div class="flex justify-between">
                        <div>{{$list_comment[$name] ?? ''}}</div>
                        @if($salaries->isNotEmpty())
                            <div class="self-center"><x-elements.crud.sort-by field="{{$name}}" :sortBy="$sortBy" :sortDirection="$sortDirection" /></div>
                        @endif
                    </div>
                </th>

                @php $name = 'date' @endphp
                <th class="px-2 py-1 {{$class[$name] ?? null}}">
                    <div class="flex justify-between">
                        <div>{{$list_comment[$name] ?? ''}}</div>
                        @if($salaries->isNotEmpty())
                            <div class="self-center"><x-elements.crud.sort-by field="{{$name}}" :sortBy="$sortBy" :sortDirection="$sortDirection" /></div>
                        @endif
                    </div>
                </th>

                @php $name = 'amount' @endphp
                <th class="px-2 py-1 {{$class[$name] ?? null}}">
                    <div class="flex justify-between">
                        <div>{{$list_comment[$name] ?? ''}}</div>
                        @if($salaries->isNotEmpty())
                            <div class="self-center"><x-elements.crud.sort-by field="{{$name}}" :sortBy="$sortBy" :sortDirection="$sortDirection" /></div>
                        @endif
                    </div>
                </th>

                @php $name = 'payment_status' @endphp
                <th class="px-2 py-1 {{$class[$name] ?? null}}">
                    <div class="flex justify-between">
                        <div>{{$list_comment[$name] ?? ''}}</div>
                        @if($salaries->isNotEmpty())
                            <div class="self-center"><x-elements.crud.sort-by field="{{$name}}" :sortBy="$sortBy" :sortDirection="$sortDirection" /></div>
                        @endif
                    </div>
                </th>

                @php $name = 'action' @endphp
                <th class="px-2 py-1 {{$class[$name] ?? null}}">
                    Acción
                </th>
            </tr>
        </thead>

        <tbody>
            {{-- 'employee_id','currency_id','date','amount','payment_status' --}}
            @forelse ($salaries as $item)
                <tr class="border-t text-xs text-gray-600 border-gray-200 {{ ($loop->iteration % 2 == 0) ? 'bg-gray-100':'bg-white'}}">
                    @php $name = 'index' @endphp
                    <td class="px-2 py-1 {{$class[$name] ?? null}}">
                        {{$loop->iteration}}
                    </td>

                    @php $name = 'employee_id' @endphp
                    <td class="px-2 py-1 {{$class[$name] ?? null}}">
                        @php $employee = $item->employee @endphp
                        {{$employee->name ?? null}}
                        <div class="">{{$employee->ci ?? null}}</div>
                    </td>

                    @php $name = 'date' @endphp
                    <td class="px-2 py-1 {{$class[$name] ?? null}}">
                        {{ $item->{$name} }}
                    </td>

                    @php $name = 'amount' @endphp
                    <td class="px-2 py-1 {{$class[$name] ?? null}}">
                        {{ $item->{$name} }}
                        @php $currency = $item->currency @endphp
                        <span>{{$currency->name ?? null}}</span>
                    </td>

                    @php $name = 'payment_status' @endphp
                    <td class="px-2 py-1 {{$class[$name] ?? null}}">
                        {{ $item->{$name} }}
                    </td>

                    @php $name = 'action' @endphp
                    <td class="px-2 py-1 {{$class[$name] ?? null}}">

                        <div class="flex items-center space-x-end">
                            <x-button squared sm wire:click="show({{$item->id}})" info icon="information-circle" class="px-4 rounded-l"/>
                            <x-button squared sm wire:click="edit({{$item->id}})" warning icon="pencil-alt" class="px-4"/>
                            <x-button squared sm wire:click="deleteQuestion({{$item->id}})" negative icon="x" class="px-4 rounded-r" />
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

    {{ $salaries->links() }}

</div>
