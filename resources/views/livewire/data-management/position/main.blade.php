<table class="w-full text-left">
    <thead class="bg-gray-50 dark:bg-gray-800">
        <tr>
            <th class="px-6 py-3">Usuario</th>
            <th class="px-6 py-3">Area</th>
            <th class="px-6 py-3">Rol</th>
            <th class="px-6 py-3">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($positions as $position)
            <tr class="border-t border-gray-200 dark:border-gray-700">
                <td class="px-6 py-4">{{ $position->full_name ?? null}}</td>
                <td class="px-6 py-4">{{ $position->area_name ?? null}}</td>
                <td class="px-6 py-4">{{ $position->rol_name ?? null}}</td>
                <td class="px-6 py-4 space-x-2 flex">
                    <x-wireui-mini-button warning flat icon="pencil" wire:click="edit({{ $position->id }})" />
                    <x-wireui-mini-button negative flat icon="trash" :disabled="$position->is_active" wire:click="confirmDelete({{ $position->id }})" />
                </td>
            </tr>
        @endforeach

        @if ($workers->count() === 0)
            <tr>
                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                    No se encontraron trabajadores
                </td>
            </tr>
        @endif
    </tbody>
</table>