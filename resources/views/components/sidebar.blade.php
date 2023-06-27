<aside
    class="w-full max-w-[100vw] min-h-screen p-4 bg-white hidden fixed inset-0 z-10 overflow-y-auto [&::-webkit-scrollbar]:hidden [-ms-overflow-style:'none'] [scrollbar-width:'none'] [&.open]:block lg:w-80 lg:border-r lg:border-solid lg:border-gray-300 lg:block"
    data-sidebar="{{ $name }}">
    {{ $slot }}
</aside>

@once
    @push('aside')
        <script defer>
            const sidebarOpenBtns = document.querySelectorAll("button[data-sidebar-open]");
            const sidebarCloseBtns = document.querySelectorAll("button[data-sidebar-close]");

            sidebarOpenBtns.forEach((element) => {
                element.addEventListener("click", () => {
                    const sidebarToOpen = element.getAttribute("data-sidebar-open");
                    const sidebar = document.querySelector(
                        `[data-sidebar="${sidebarToOpen}"]`
                    );
                    sidebar?.classList.add("open");
                });
            });

            sidebarCloseBtns.forEach((element) => {
                element.addEventListener("click", () => {
                    const sidebarToClose = element.getAttribute("data-sidebar-close");
                    const sidebar = document.querySelector(
                        `[data-sidebar="${sidebarToClose}"]`
                    );
                    sidebar?.classList.remove("open");
                })
            })
        </script>
    @endpush
@endonce
