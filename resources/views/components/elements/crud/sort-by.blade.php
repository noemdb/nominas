<div>

    @if ($sortBy == $field)
        @if($sortDirection=="asc")
            <x-icon name="sort-ascending" wire:click="getSortBy('{{$sortBy}}','asc')" class="cursor-pointer w-4 h-4 text-gray-600 dark:text-gray-200" wire:key="btn-sort-{{Str::random(40)}}"/>
        @endif
        @if($sortDirection=="desc")
            <x-icon name="sort-descending" wire:click="getSortBy('{{$sortBy}}','desc')" class="cursor-pointer w-4 h-4 text-gray-600 dark:text-gray-200" wire:key="btn-sort-{{Str::random(40)}}"/>
        @endif
    @else
        <x-icon name="dots-vertical" wire:click="getSortBy('{{$field}}','asc')" class="cursor-pointer w-4 h-4 text-gray-600 dark:text-gray-200" wire:key="btn-sort-{{Str::random(40)}}"/>
    @endif

</div>
