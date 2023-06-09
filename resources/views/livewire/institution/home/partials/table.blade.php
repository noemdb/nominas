<div class="overflow-x-auto">
    <table class="table-auto w-full text-left whitespace-no-wrap">
        <thead>
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">Tipo</th>
                <th class="px-4 py-2">Dirección</th>
                <th class="px-4 py-2">Teléfono</th>
                <th class="px-4 py-2">Acción</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($institutions as $item)
                <tr class="border-t border-gray-200">
                    <td class="px-4 py-2">{{$loop->iteration}}</td>
                    <td class="px-4 py-2">{{$item->name}}</td>
                    <td class="px-4 py-2">{{$item->type}}</td>
                    <td class="px-4 py-2">{{$item->email}}</td>
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
