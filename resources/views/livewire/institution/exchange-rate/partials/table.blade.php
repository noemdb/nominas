@php
    $class['index'] = 'hidden sm:table-cell';
    $class['institution_name'] = '';
    $class['name'] = '';
    $class['symbol'] = 'hidden md:table-cell';
    $class['status_referential'] = 'hidden lg:table-cell';
    $class['status_cripto'] = 'hidden lg:table-cell';
    $class['status_forgering'] = 'hidden lg:table-cell';
    $class['action'] = '';
@endphp
{{-- 'currency_name','currency_referential_name','date','amount','source','status_official' --}}

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
            {{-- 'currency_name','currency_referential_name','date','amount','source','status_official' --}}

            <tr class="bg-gray-200 text-sm">
                @php $name = 'index' @endphp
                <th class="px-2 py-1 {{$class[$name] ?? null}}">
                    ID
                </th>

                @php $name = 'currency_name' @endphp
                <th class="px-2 py-1 {{$class[$name] ?? null}}">
                    <div class="flex justify-between">
                        <div>{{$list_comment[$name] ?? ''}}</div>
                        @if($exchange_rates->isNotEmpty())
                            <div class="self-center"><x-elements.crud.sort-by field="{{$name}}" :sortBy="$sortBy" :sortDirection="$sortDirection" /></div>
                        @endif
                    </div>
                </th>

                @php $name = 'currency_referential_id' @endphp
                <th class="px-2 py-1 {{$class[$name] ?? null}}">
                    <div class="flex justify-between">
                        <div>{{$list_comment[$name] ?? ''}}</div>
                        @if($exchange_rates->isNotEmpty())
                            <div class="self-center"><x-elements.crud.sort-by field="{{$name}}" :sortBy="$sortBy" :sortDirection="$sortDirection" /></div>
                        @endif
                    </div>
                </th>

                @php $name = 'date' @endphp
                <th class="px-2 py-1 {{$class[$name] ?? null}}">
                    <div class="flex justify-between">
                        <div>{{$list_comment[$name] ?? ''}}</div>
                        @if($exchange_rates->isNotEmpty())
                            <div class="self-center"><x-elements.crud.sort-by field="{{$name}}" :sortBy="$sortBy" :sortDirection="$sortDirection" /></div>
                        @endif
                    </div>
                </th>

                @php $name = 'amount' @endphp
                <th class="px-2 py-1 {{$class[$name] ?? null}}">
                    <div class="flex justify-between">
                        <div>{{$list_comment[$name] ?? ''}}</div>
                        @if($exchange_rates->isNotEmpty())
                            <div class="self-center"><x-elements.crud.sort-by field="{{$name}}" :sortBy="$sortBy" :sortDirection="$sortDirection" /></div>
                        @endif
                    </div>
                </th>

                @php $name = 'source' @endphp
                <th class="px-2 py-1 {{$class[$name] ?? null}}">
                    <div class="flex justify-between">
                        <div>{{$list_comment[$name] ?? ''}}</div>
                        @if($exchange_rates->isNotEmpty())
                            <div class="self-center"><x-elements.crud.sort-by field="{{$name}}" :sortBy="$sortBy" :sortDirection="$sortDirection" /></div>
                        @endif
                    </div>
                </th>

                @php $name = 'status_official' @endphp
                <th class="px-2 py-1 {{$class[$name] ?? null}}">
                    <div class="flex justify-between">
                        <div>{{$list_comment[$name] ?? ''}}</div>
                        @if($exchange_rates->isNotEmpty())
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
            {{-- 'currency_name','currency_referential_name','date','amount','source','status_official' --}}
            @forelse ($exchange_rates as $item)
                <tr class="border-t text-xs text-gray-600 border-gray-200 {{ ($loop->iteration % 2 == 0) ? 'bg-gray-100':'bg-white'}}">
                    @php $name = 'index' @endphp
                    <td class="px-2 py-1 {{$class[$name] ?? null}}">
                        {{$loop->iteration}}
                    </td>

                    @php $name = 'currency_name' @endphp
                    <td class="px-2 py-1 {{$class[$name] ?? null}}">
                        @php $currency = $item->currency; @endphp
                        {{ $currency->name ?? null }} <span class="text-md">[{{ $currency->symbol ?? null }}] </span>
                    </td>

                    @php $name = 'currency_referential_name' @endphp
                    <td class="px-2 py-1 {{$class[$name] ?? null}}">
                        @php $currency = $item->currency_referential; @endphp
                        {{ $currency->name ?? null }} <span class="text-md">[{{ $currency->symbol ?? null }}] </span>
                    </td>

                    @php $name = 'date' @endphp
                    <td class="px-2 py-1 {{$class[$name] ?? null}}">
                        {{$item->{$name}->format('d-m-Y')}}
                    </td>

                    @php $name = 'amount' @endphp
                    <td class="px-2 py-1 {{$class[$name] ?? null}}">
                        {{$item->{$name} ?? null}}
                    </td>

                    @php $name = 'source' @endphp
                    <td class="px-2 py-1 {{$class[$name] ?? null}}">
                        {{$item->{$name} ?? null}}
                    </td>

                    @php $name = 'status_official' @endphp
                    <td class="px-2 py-1 {{$class[$name] ?? null}}">
                        {{($item->{$name}) ? 'SI':'NO'}}
                    </td>

                    @php $name = 'action' @endphp
                    <td class="px-2 py-1 {{$class[$name] ?? null}}">

                        <div class="flex items-center space-x-end">
                            <x-button squared sm wire:click="show({{$item->id}})" info icon="information-circle" class="px-4 rounded"/>
                            {{-- <x-button squared sm wire:click="edit({{$item->id}})" warning icon="pencil-alt" class="px-4"/> --}}
                            {{-- <x-button squared sm wire:click="deleteQuestion({{$item->id}})" negative icon="x" class="px-4 rounded-r" /> --}}
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

    {{ $exchange_rates->links() }}

</div>
