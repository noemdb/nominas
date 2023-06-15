@php
    $class['index']='hidden sm:table-cell';
    $class['name']='';
    $class['type']='hidden md:table-cell';
    $class['address']='hidden lg:table-cell';
    $class['registration_number']='hidden md:table-cell';
    $class['action']='';
@endphp

<div class="mb-4 flex justify-between">
    <div class="px-2 w-3/4">
        @php $name = 'search'; $model = 'institution.'.$name; @endphp
        <div class="flex justify-between">
            <div wire:loading class="text-black font-semibold fixed	 bottom-0 right-0 z-10 bg-white rounded border shadow mr-2 mb-2 dark:text-gray-100"> Cargando... </div>
        </div>
        @php $label = "Nombre, tipo, dirección o número de registro" @endphp
        <x-input wire:model.debounce.500ms="{{$name}}" icon="search" label="{{$label}}" placeholder="{{$label}}" >
            <x-slot name="append">
                <div class="absolute inset-y-0 right-0 flex items-center p-0.5 text-gray-600">
                    <x-icon name="x" class="w-4 h-4" wire:click="cleanSearch()"/>
                </div>
            </x-slot>
        </x-input>
    </div>
    <div class="px-2 w-1/4">
        <x-select label="Registros" title="Registros por página" wire:model="paginate" placeholder="páginas" :options="$paginate_list" />
    </div>
</div>

{{-- <x-errors /> --}}

<div class="overflow-x-auto">
    <table class="table-auto w-full text-left whitespace-no-wrap">
        <thead>
            <tr>
                <th class="px-4 py-2 {{$class['index'] ?? null}}">
                    ID
                </th>
                <th class="px-4 py-2 {{$class['name'] ?? null}}">
                    <div class="flex justify-between">
                        @php $name = 'name' @endphp
                        <div>{{$list_comment[$name] ?? ''}}</div>
                        @if($institutions->isNotEmpty())
                            <div class="self-center"><x-elements.crud.sort-by field="{{$name}}" :sortBy="$sortBy" :sortDirection="$sortDirection" /></div>
                        @endif
                    </div>
                </th>
                <th class="px-4 py-2 {{$class['type'] ?? null}}">
                    <div class="flex justify-between">
                        @php $name = 'type' @endphp
                        <div>{{$list_comment[$name] ?? ''}}</div>
                        @if($institutions->isNotEmpty())
                            <div class="self-center"><x-elements.crud.sort-by field="{{$name}}" :sortBy="$sortBy" :sortDirection="$sortDirection" /></div>
                        @endif
                    </div>
                </th>
                <th class="px-4 py-2 {{$class['address'] ?? null}}">
                    <div class="flex justify-between">
                        @php $name = 'address' @endphp
                        <div>{{$list_comment[$name] ?? ''}}</div>
                        @if($institutions->isNotEmpty())
                            <div class="self-center"><x-elements.crud.sort-by field="{{$name}}" :sortBy="$sortBy" :sortDirection="$sortDirection" /></div>
                        @endif
                    </div>
                </th>
                <th class="px-4 py-2 {{$class['registration_number'] ?? null}}">
                    <div class="flex justify-between">
                        @php $name = 'registration_number' @endphp
                        <div>{{$list_comment[$name] ?? ''}}</div>
                        @if($institutions->isNotEmpty())
                            <div class="self-center"><x-elements.crud.sort-by field="{{$name}}" :sortBy="$sortBy" :sortDirection="$sortDirection" /></div>
                        @endif
                    </div>
                </th>
                <th class="px-4 py-2 {{$class['action'] ?? null}}">
                    Acción
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($institutions as $item)
                <tr class="border-t border-gray-200">
                    <td class="px-4 py-2 {{$class['index'] ?? null}}">
                        {{$loop->iteration}}
                    </td>
                    <td class="px-4 py-2 {{$class['name'] ?? null}}">
                        {{$item->name}}
                        @foreach ($item->authorities as $authority)
                            <div class="text-xs text-gray-800">{{$loop->iteration}}. {{$authority->name}}</div>
                        @endforeach
                    </td>
                    <td class="px-4 py-2 {{$class['type'] ?? null}}">
                        {{$item->type}}
                    </td>
                    <td class="px-4 py-2 {{$class['address'] ?? null}}">
                        {{$item->address}}
                    </td>
                    <td class="px-4 py-2 {{$class['registration_number'] ?? null}}">
                        {{$item->registration_number}}
                    </td>
                    <td class="px-4 py-2 {{$class['action'] ?? null}}">

                        <div class="flex items-center space-x-end">
                            <x-button sm wire:click="show({{$item->id}})" info icon="information-circle" class="px-4"/>
                            <x-button sm wire:click="edit({{$item->id}})" warning icon="pencil-alt" class="px-4"/>
                            <x-button sm wire:click="deleteQuestion({{$item->id}})" negative icon="x" class="px-4" />
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

    {{ $institutions->links() }}

</div>
