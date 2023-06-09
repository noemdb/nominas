<article class="p-4 border border-neutral-200 rounded-lg relative">
    <div class="mb-2 flex justify-between items-center" x-data="{ isOpen: false }">
        <h6 class="text-neutral-500">{{ $title }}</h6>
        @if ($description != '')
            <button class="w-4 h-4" @click="isOpen = !isOpen">
                <x-icon name="information-circle" class="text-neutral-500" />
            </button>
            <div class="w-3/4 max-h-[75%] p-4 bg-white border border-solid border-neutral-900/10 rounded-lg shadow-md shadow-neutral-900/20 absolute top-10 right-4 overflow-y-scroll [&::-webkit-scrollbar]:hidden [-ms-overflow-style:'none'] [scrollbar-width:'none']"
                x-show="isOpen">
                <p class="text-neutral-500 text-sm">{{ $description }}</p>
            </div>
        @endif
    </div>
    <p @class([
        'mb-4 text-xl font-bold',
        'text-green-700' => $isPositive,
        'text-red-700' => !$isPositive,
    ])>{{ $value }} {{ $unit }}</p>
    <div class="flex items-center">
        <p>
            <span @class([
                'w-5 h-5 inline-block align-text-bottom',
                'text-green-700' => $isPositive,
                'text-red-700 rotate-90' => !$isPositive,
            ])>
                <x-icons.trending />
            </span>
            <span class="text-green-700 font-bold">
                {{ $comparativePercentageValue }}%
            </span>
            vs. hace {{ $comparativePercentageTimePeriod }}
        </p>
    </div>
</article>
