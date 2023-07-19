@php
    $class['index'] = 'hidden sm:table-cell';
    $class['employee_id'] = '';
    $class['date'] = '';
    $class['gross_salary'] = 'hidden md:table-cell';
    $class['net_salary'] = 'hidden lg:table-cell';
    $class['tax_deductions'] = 'hidden lg:table-cell';
    $class['other_deductions'] = 'hidden lg:table-cell';
    $class['total_deductions'] = '';
    $class['total_additions'] = '';
    $class['total_pay'] = '';
    $class['action'] = '';
@endphp
{{-- 'employee_id','date','gross_salary','net_salary','tax_deductions','other_deductions','total_deductions','total_additions','total_pay' --}}

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
        @php $label = "Nombre, CI" @endphp
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
            {{-- 'employee_id','date','gross_salary','net_salary','tax_deductions','other_deductions','total_deductions','total_additions','total_pay' --}}

            <tr class="bg-gray-200 text-sm">
                @php $name = 'index' @endphp
                <th class="px-2 py-1 {{$class[$name] ?? null}}">
                    ID
                </th>

                @php $name = 'employee_id' @endphp
                <th class="px-2 py-1 {{$class[$name] ?? null}}">
                    <div class="flex justify-between">
                        <div>{{$list_comment[$name] ?? ''}}</div>
                        @if($settlements->isNotEmpty())
                            <div class="self-center"><x-elements.crud.sort-by field="{{$name}}" :sortBy="$sortBy" :sortDirection="$sortDirection" /></div>
                        @endif
                    </div>
                </th>

                @php $name = 'date' @endphp
                <th class="px-2 py-1 {{$class[$name] ?? null}}">
                    <div class="flex justify-between">
                        <div>{{$list_comment[$name] ?? ''}}</div>
                        @if($settlements->isNotEmpty())
                            <div class="self-center"><x-elements.crud.sort-by field="{{$name}}" :sortBy="$sortBy" :sortDirection="$sortDirection" /></div>
                        @endif
                    </div>
                </th>

                @php $name = 'gross_salary' @endphp
                <th class="px-2 py-1 {{$class[$name] ?? null}}">
                    <div class="flex justify-between">
                        <div>{{$list_comment[$name] ?? ''}}</div>
                        @if($settlements->isNotEmpty())
                            <div class="self-center"><x-elements.crud.sort-by field="{{$name}}" :sortBy="$sortBy" :sortDirection="$sortDirection" /></div>
                        @endif
                    </div>
                </th>

                @php $name = 'net_salary' @endphp
                <th class="px-2 py-1 {{$class[$name] ?? null}}">
                    <div class="flex justify-between">
                        <div>{{$list_comment[$name] ?? ''}}</div>
                        @if($settlements->isNotEmpty())
                            <div class="self-center"><x-elements.crud.sort-by field="{{$name}}" :sortBy="$sortBy" :sortDirection="$sortDirection" /></div>
                        @endif
                    </div>
                </th>

                @php $name = 'tax_deductions' @endphp
                <th class="px-2 py-1 {{$class[$name] ?? null}}">
                    <div class="flex justify-between">
                        <div>{{$list_comment[$name] ?? ''}}</div>
                        @if($settlements->isNotEmpty())
                            <div class="self-center"><x-elements.crud.sort-by field="{{$name}}" :sortBy="$sortBy" :sortDirection="$sortDirection" /></div>
                        @endif
                    </div>
                </th>

                @php $name = 'other_deductions' @endphp
                <th class="px-2 py-1 {{$class[$name] ?? null}}">
                    <div class="flex justify-between">
                        <div>{{$list_comment[$name] ?? ''}}</div>
                        @if($settlements->isNotEmpty())
                            <div class="self-center"><x-elements.crud.sort-by field="{{$name}}" :sortBy="$sortBy" :sortDirection="$sortDirection" /></div>
                        @endif
                    </div>
                </th>


                @php $name = 'total_deductions' @endphp
                <th class="px-2 py-1 {{$class[$name] ?? null}}">
                    <div class="flex justify-between">
                        <div>{{$list_comment[$name] ?? ''}}</div>
                        @if($settlements->isNotEmpty())
                            <div class="self-center"><x-elements.crud.sort-by field="{{$name}}" :sortBy="$sortBy" :sortDirection="$sortDirection" /></div>
                        @endif
                    </div>
                </th>

                @php $name = 'total_additions' @endphp
                <th class="px-2 py-1 {{$class[$name] ?? null}}">
                    <div class="flex justify-between">
                        <div>{{$list_comment[$name] ?? ''}}</div>
                        @if($settlements->isNotEmpty())
                            <div class="self-center"><x-elements.crud.sort-by field="{{$name}}" :sortBy="$sortBy" :sortDirection="$sortDirection" /></div>
                        @endif
                    </div>
                </th>

                @php $name = 'total_pay' @endphp
                <th class="px-2 py-1 {{$class[$name] ?? null}}">
                    <div class="flex justify-between">
                        <div>{{$list_comment[$name] ?? ''}}</div>
                        @if($settlements->isNotEmpty())
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
            {{-- 'employee_id','date','gross_salary','net_salary','tax_deductions','other_deductions','total_deductions','total_additions','total_pay' --}}
            @forelse ($settlements as $item)
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
                    <td class="px-2 py-1 {{$class[$name] ?? null}}  whitespace-nowrap">
                        {{ $item->{$name}->format('d-m-Y') }}
                    </td>

                    @php $name = 'gross_salary' @endphp
                    <td class="px-2 py-1 {{$class[$name] ?? null}}">
                        {{ $item->{$name} }}
                        @php $currency = $item->currency @endphp
                        <span>{{$currency->name ?? null}}</span>
                    </td>

                    @php $name = 'net_salary' @endphp
                    <td class="px-2 py-1 {{$class[$name] ?? null}}">
                        {{ $item->{$name} }}
                        @php $currency = $item->currency @endphp
                        <span>{{$currency->name ?? null}}</span>
                    </td>

                    @php $name = 'tax_deductions' @endphp
                    <td class="px-2 py-1 {{$class[$name] ?? null}}">
                        {{ $item->{$name} }}
                        @php $currency = $item->currency @endphp
                        <span>{{$currency->name ?? null}}</span>
                    </td>

                    @php $name = 'other_deductions' @endphp
                    <td class="px-2 py-1 {{$class[$name] ?? null}}">
                        {{ $item->{$name} }}
                        @php $currency = $item->currency @endphp
                        <span>{{$currency->name ?? null}}</span>
                    </td>

                    @php $name = 'total_deductions' @endphp
                    <td class="px-2 py-1 {{$class[$name] ?? null}}">
                        {{ $item->{$name} }}
                        @php $currency = $item->currency @endphp
                        <span>{{$currency->name ?? null}}</span>
                    </td>

                    @php $name = 'total_additions' @endphp
                    <td class="px-2 py-1 {{$class[$name] ?? null}}">
                        {{ $item->{$name} }}
                        @php $currency = $item->currency @endphp
                        <span>{{$currency->name ?? null}}</span>
                    </td>

                    @php $name = 'total_pay' @endphp
                    <td class="px-2 py-1 {{$class[$name] ?? null}}">
                        {{ $item->{$name} }}
                        @php $currency = $item->currency @endphp
                        <span>{{$currency->name ?? null}}</span>
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

    {{ $settlements->links() }}

</div>
