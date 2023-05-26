<div class="{{ $cardClasses ?? null }}">
    @if ($header)
        {{ $header }}
    @elseif ($title || $action)
        <div class="{{ $headerClasses }}">
            <h3 class="text-center text-xl text-gray-400 font-semibold mb-2 w-full">{!! $title !!}</h3>
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

            {{ $footer }}

            @if ($porc)
                <div class="w-full bg-gray-200 rounded-full mt-2">
                    <div class="bg-blue-500 h-1 rounded-full sm:w-3/4 md:w-1/2 lg:w-1/4" style="width: {{$porc}}%;"></div>
                </div>
            @endif

        </div>

    @endif

</div>
