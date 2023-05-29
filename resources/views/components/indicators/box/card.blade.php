<div class="{{ $cardClasses ?? null }}">
    @if ($header)
        {{ $header }}
    @elseif ($title || $action)
        <div class="{{ $headerClasses }}">
            <h5 class="text-center text-lg text-gray-400 font-semibold mb-1 w-full">{!! $title !!}</h5>
            @if ($action)
                {{ $action }}
            @endif
        </div>
    @endif

    @if ($count)
        <div class="flex justify-center items-center">
            <div class="text-blue-400 text-5xl font-medium block text-center p-4 m-4">
                <span class="rounded-full border p-4 m-0 w-16 h-16">{{$count}}@if ($unit)<span class="text-sm">{{$unit}}</span>@endif</span>
            </div>
        </div>
    @endif

    {{-- @if (!empty($slot))
        <div {{ $attributes->merge(['class' => "{$padding} text-secondary-700 rounded-b-xl grow dark:text-secondary-400"]) }}>
            {{ $slot }}
        </div>
    @endif --}}

    @if ($description)
        <p class="text-sm text-gray-400">{{$description}}</p>
    @endif

    @if ($footer)

        <div class="text-sm text-gray-400 {{ $footerClasses }}">

            @if (Str::length($footer) <= 20)
                {{ $footer }}
            @else
                <div x-data="{ isOpen: false }">

                    <button @click="isOpen = !isOpen" class="border-b w-full py-2">
                        {{ Str::limit($footer,20,'...') }}
                        {{-- <x-icon name="dots-vertical" class="w-4 h-4 text-gray-500" /> --}}
                    </button>
                    <div x-show="isOpen" class="py-2">
                        {{$footer}}
                    </div>
                </div>
            @endif

            @if ($porc)
                <div class="w-full bg-gray-200 rounded-full mt-2">
                    <div class="bg-blue-500 h-1 rounded-full sm:w-3/4 md:w-1/2 lg:w-1/4" style="width: {{$porc}}%;"></div>
                </div>
            @endif

        </div>

    @endif

</div>
