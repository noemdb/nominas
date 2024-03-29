@php
    $class['index']='hidden sm:table-cell';
    $class['employee_name']='';
    $class['name']='';
    $class['description']='hidden xl:table-cell';
    $class['lapse']='hidden md:table-cell';
    $class['start_salary']='hidden sm:table-cell';
    $class['action']='';
    /* index, employee_id, name, description, lapse, action */
@endphp

{{-- <div class="mb-4 flex justify-between"> --}}
<div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
    <div class="col-span-1 sm:col-span-3">
        @php $name = 'search'; $model = 'employee.'.$name; @endphp
        <div class="flex justify-between">
            <div wire:loading class="text-black font-semibold fixed	 bottom-0 right-0 z-10 bg-white rounded border shadow mr-2 mb-2 dark:text-gray-100"> Cargando... </div>
        </div>
        @php $label = "Nombre, ci, cargo actual" @endphp
        <x-input wire:model.debounce.500ms="{{$name}}" icon="search" label="{{$label}}" placeholder="{{$label}}" >

            <x-slot name="append">
                <div class="absolute inset-y-0 right-0 flex items-center p-0.5">
                    <x-button wire:click="cleanSearch()" class="h-full rounded-r-md" icon="x" flat squared />
                </div>
            </x-slot>

        </x-input>
    </div>
    <div class="col-span-1 sm:col-span-1">
        <x-select label="Registros" title="Registros por página" wire:model="paginate" placeholder="páginas" :options="$paginate_list" />
    </div>
</div>

{{-- <x-errors /> --}}

<div class="overflow-x-auto">
    <table class="table-auto w-full text-left whitespace-no-wrap my-2">
        <thead>
            {{-- /* index, employee_name, name, description, lapse, action */ --}}

            <tr class="bg-gray-200 text-sm">
                @php $name = 'index' @endphp
                <th class="px-2 py-1 {{$class[$name] ?? null}}">
                    ID
                </th>

                @php $name = 'position_name' @endphp
                <th class="px-2 py-1 {{$class[$name] ?? null}}">
                    <div class="flex justify-between">
                        <div>{{$list_comment[$name] ?? ''}}</div>
                        @if($positions->isNotEmpty())
                            <div class="self-center"><x-elements.crud.sort-by field="{{$name}}" :sortBy="$sortBy" :sortDirection="$sortDirection" /></div>
                        @endif
                    </div>
                </th>

                @php $name = 'name' @endphp
                <th class="px-2 py-1 {{$class[$name] ?? null}}">
                    <div class="flex justify-between">
                        <div>{{$list_comment[$name] ?? ''}}</div>
                        @if($positions->isNotEmpty())
                            <div class="self-center"><x-elements.crud.sort-by field="{{$name}}" :sortBy="$sortBy" :sortDirection="$sortDirection" /></div>
                        @endif
                    </div>
                </th>

                @php $name = 'description' @endphp
                <th class="px-2 py-1 {{$class[$name] ?? null}}">
                    <div class="flex justify-between">
                        <div>{{$list_comment[$name] ?? ''}}</div>
                        @if($positions->isNotEmpty())
                            <div class="self-center"><x-elements.crud.sort-by field="{{$name}}" :sortBy="$sortBy" :sortDirection="$sortDirection" /></div>
                        @endif
                    </div>
                </th>

                @php $name = 'lapse' @endphp
                <th class="px-2 py-1 {{$class[$name] ?? null}}">
                    <div class="flex justify-between">
                        <div>{{$list_comment[$name] ?? ''}}</div>
                        @if($positions->isNotEmpty())
                            <div class="self-center"><x-elements.crud.sort-by field="{{$name}}" :sortBy="$sortBy" :sortDirection="$sortDirection" /></div>
                        @endif
                    </div>
                </th>

                @php $name = 'start_salary' @endphp
                <th class="px-2 py-1 {{$class[$name] ?? null}}">
                    <div class="flex justify-between">
                        <div>{{$list_comment[$name] ?? ''}}</div>
                        @if($positions->isNotEmpty())
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
            {{-- /* index, employee_name, name, description, lapse, action */ --}}
            @forelse ($positions as $item)
                <tr class="border-t text-xs text-gray-600 border-gray-200 {{ ($loop->iteration % 2 == 0) ? 'bg-gray-100':'bg-white'}}">
                    @php $name = 'index' @endphp
                    <td class="px-2 py-1 {{$class[$name] ?? null}}">
                        {{$loop->iteration}}
                    </td>

                    @php $name = 'position_name' @endphp
                    <td class="px-2 py-1 {{$class[$name] ?? null}}">
                        {{$item->$name}}
                        <div class="text-xs text-gray-400">{{($item->area) ? $item->area->name : null}} || {{($item->rol) ? $item->rol->name : null}}</div>
                    </td>

                    @php $name = 'name' @endphp
                    <td class="px-2 py-1 {{$class[$name] ?? null}}">
                        {{$item->$name}}
                    </td>

                    @php $name = 'description' @endphp
                    <td class="px-2 py-1 {{$class[$name] ?? null}}">
                        {{$item->$name ?? null}}
                    </td>

                    @php $name = 'lapse' @endphp
                    <td class="px-2 py-1 {{$class[$name] ?? null}} whitespace-nowrap">
                        {{$item->$name}}
                    </td>

                    @php $name = 'start_salary' @endphp
                    <td class="px-2 py-1 {{$class[$name] ?? null}}">
                        {{$item->{$name}->format('d-m-Y')}}
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

    {{ $positions->links() }}

</div>
