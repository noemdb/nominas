<div class="mb-4 flex justify-between">
    <div class="px-2 w-3/4">
        @php $name = 'search'; $model = 'institution.'.$name; @endphp
        <div class="flex justify-between">
            <div wire:loading class="text-black font-semibold fixed	 bottom-0 right-0 z-10 bg-white rounded border shadow mr-2 mb-2 dark:text-gray-100"> Cargando... </div>
        </div>
        @php $label = "Nombre, tipo, dirección o teléfono" @endphp
        <x-input wire:model.debounce.500ms="{{$name}}" icon="search" label="{{$label}}" placeholder="{{$label}}" >
            <x-slot name="append">
                <div class="absolute inset-y-0 right-0 flex items-center p-0.5 text-gray-600">
                    <x-icon name="x" class="w-4 h-4" wire:click="cleanSearch()"/>
                </div>
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
                        <div>{{$list_comment[$name] ?? ''}}</div>
                        @if($institutions->isNotEmpty())
                            <x-elements.crud.sort-by field="{{$name}}" :sortBy="$sortBy" :sortDirection="$sortDirection" />
                        @endif
                    </div>
                </th>
                <th class="px-4 py-2">
                    <div class="flex justify-between">
                        @php $name = 'type' @endphp
                        <div>{{$list_comment[$name] ?? ''}}</div>
                        @if($institutions->isNotEmpty())
                            <x-elements.crud.sort-by field="{{$name}}" :sortBy="$sortBy" :sortDirection="$sortDirection" />
                        @endif
                    </div>
                </th>
                <th class="px-4 py-2">
                    <div class="flex justify-between">
                        @php $name = 'address' @endphp
                        <div>{{$list_comment[$name] ?? ''}}</div>
                        @if($institutions->isNotEmpty())
                            <x-elements.crud.sort-by field="{{$name}}" :sortBy="$sortBy" :sortDirection="$sortDirection" />
                        @endif
                    </div>
                </th>
                <th class="px-4 py-2">
                    <div class="flex justify-between">
                        @php $name = 'registration_number' @endphp
                        <div>{{$list_comment[$name] ?? ''}}</div>
                        @if($institutions->isNotEmpty())
                            <x-elements.crud.sort-by field="{{$name}}" :sortBy="$sortBy" :sortDirection="$sortDirection" />
                        @endif
                    </div>
                </th>
                <th class="px-4 py-2">Acción</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($institutions as $item)
                <tr class="border-t border-gray-200">
                    <td class="px-4 py-2">{{$loop->iteration}}</td>
                    <td class="px-4 py-2">{{$item->name}}</td>
                    <td class="px-4 py-2">{{$item->type}}</td>
                    <td class="px-4 py-2">{{$item->address}}</td>
                    <td class="px-4 py-2">{{$item->registration_number}}</td>
                    <td class="px-4 py-2">
                        <div class="flex">
                            {{-- <x-button.circle primary icon="pencil" /> --}}
                            {{-- <x-button.circle  wire:click="openModal({{$item->id}})" warning icon="pencil" class="mx-1"/> --}}
                            {{-- <x-button.circle  wire:click="openModal('{{$item->id}}')" warning icon="pencil" class="mx-1"/> --}}

                            {{-- @include('livewire.institution.home.modals.edit') --}}

                            {{-- <x-button.circle wire:click="$toggle('showModal')" primary icon="clipboard-list" class="mx-1"/> --}}
                            <x-button.circle wire:click="edit({{$item->id}})" primary icon="clipboard-list" class="mx-1"/>
                            <x-button.circle wire:click="deleteQuestion({{$item->id}})" negative icon="x" class="mx-1"/>

                            {{-- <x-button.circle primary label="+" class="mx-1"/> --}}

                        </div>
                        {{-- <x-button.circle wire:click="openModal({{$item->id}})" info icon="pencil" /> --}}
                        {{-- <x-button.circle negative icon="x" /> --}}


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

    {{-- @include('livewire.institution.home.modals.main') --}}

</div>

{{--

name
type
acronym
address
phone_number
email
website
foundation_date
legal_status
tax_id
registration_number
logo

--}}
