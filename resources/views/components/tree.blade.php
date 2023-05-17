<nav>
    <ul class="flex flex-col">
        @foreach ($links as $link)
            <li>
                @if (array_key_exists('childrens', $link))
                    <button class="w-full p-4 rounded-lg flex items-center gap-4 hover:bg-green-100 hover:text-green-900"
                        data-trigger="{{ $link['label'] }}">
                        <div class="w-5 h-5">
                            <x-dynamic-component :component="$link['icon']" />
                        </div>
                        <span class="capitalize text-sm mr-auto">{{ $link['label'] }}</span>
                        <div class="w-3 h-3">
                            <x-icons.arrow-down />
                        </div>
                    </button>
                    <div class="hidden [&.open]:block" data-nested="{{ $link['label'] }}">
                        <x-tree :links="$link['childrens']" :isNested="true" />
                    </div>
                @else
                    <a href="#"
                        class="p-4 rounded-lg flex items-center gap-4 hover:bg-green-100 hover:text-green-900">
                        @if (!$isNested)
                            <div class="w-5 h-5">
                                <x-dynamic-component :component="$link['icon']" />
                            </div>
                        @endif
                        <span class="capitalize text-sm">{{ $link['label'] }}</span>
                    </a>
                @endif
            </li>
        @endforeach
    </ul>
</nav>

@once
    <script>
        const triggers = document.querySelectorAll("button[data-trigger]")

        triggers.forEach((element) => {
            element.addEventListener("click", () => {
                const nestedNavValue = element.getAttribute("data-trigger");
                const nestedNav = document.querySelector(`[data-nested="${nestedNavValue}"]`)
                nestedNav.classList.toggle("open")
            })
        })
    </script>
@endonce
