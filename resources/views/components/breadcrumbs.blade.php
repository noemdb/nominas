<nav>
    <ul class="flex gap-2">
        @foreach ($paths as $path)
            <li @class([
                'lowercase first-letter:uppercase',
                'text-green-700 font-bold' => $loop->last,
                'text-neutral-500' => !$loop->last,
            ])>
                {{ $path }}
            </li>
            @if (!$loop->last)
                <li class="text-neutral-500">/</li>
            @endif
        @endforeach
    </ul>
</nav>
