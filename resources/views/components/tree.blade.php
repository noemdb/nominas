<nav class="overflow-hidden">
    <ul class="flex flex-col gap-2">
        @foreach ($links as $link)
            <li>
                @if (array_key_exists('childrens', $link))
                    <button
                        class="w-full px-4 py-3 rounded-lg flex items-center gap-4 hover:bg-green-200/40 hover:text-green-900"
                        data-tree-trigger="{{ $link['label'] }}">
                        <div class="w-5 h-5">
                            <x-dynamic-component :component="$link['icon']" />
                        </div>
                        <span
                            class="mr-auto text-sm text-left lowercase first-letter:uppercase">{{ $link['label'] }}</span>
                        <div class="w-3 h-3">
                            <x-icons.arrow-down />
                        </div>
                    </button>
                    <div class="hidden [&.open]:block" data-nested-tree="{{ $link['label'] }}">
                        <x-tree :links="$link['childrens']" :isNested="true" />
                    </div>
                @else
                    <a href={{ $link['route'] }}
                        class="px-4 py-3 rounded-lg flex items-center gap-4 hover:bg-green-200/40 hover:text-green-900">
                        <div class="w-5 h-5 relative flex items-center justify-center">
                            @if ($isNested)
                                <div class="w-[1px] h-[300%] bg-neutral-300 absolute"></div>
                            @else
                                <x-dynamic-component :component="$link['icon']" />
                            @endif
                        </div>
                        <span class="text-sm lowercase text-left first-letter:uppercase">{{ $link['label'] }}</span>
                    </a>
                @endif
            </li>
        @endforeach
    </ul>
</nav>

@once
    @push('tree')
        <script defer>
            const TREE_IDENTIFIER = "openTrees";
            // Get all button that can open a nested tree
            const treeTriggers = document.querySelectorAll("button[data-tree-trigger]");
            // Get all saved opened trees
            let openTrees = JSON.parse(sessionStorage.getItem(TREE_IDENTIFIER)) ?? [];

            treeTriggers.forEach((element) => {
                element.addEventListener("click", () => {
                    const treeIdentifier = element.getAttribute("data-tree-trigger");
                    const treeSelector = `[data-nested-tree="${treeIdentifier}"]`
                    const tree = document.querySelector(treeSelector);

                    // Check if nested tree is already open
                    if (tree?.classList.contains("open")) {
                        // if so, then remove it from the saved list
                        openTrees = openTrees?.filter((treeName) => treeName !== treeIdentifier);
                    } else {
                        // else add it to the saved list
                        openTrees?.push(treeIdentifier);
                    }

                    // Here is saved the new list
                    sessionStorage.setItem(TREE_IDENTIFIER, JSON.stringify(openTrees));
                    tree?.classList.toggle("open");
                });
            });

            document.addEventListener("DOMContentLoaded", () => {
                openTrees.forEach((value) => {
                    const treeSelector = `[data-nested-tree="${value}"]`;
                    const tree = document.querySelector(treeSelector);

                    // Add class "open" to tree. Only to elements inside saved list (openTrees)
                    tree?.classList.add("open");
                });
            });
        </script>
    @endpush
@endonce
