<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 dark:bg-gray-800 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center pt-2 shrink-0">
                    <a href="{{ route('dashboard') }}" class="pt-2">
                        <x-application-logo class="block w-auto h-8 p-1 text-gray-800 fill-current dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('data-management')" :active="request()->routeIs('data-management')">
                        {{ __('Personal') }}
                    </x-nav-link>

                    <x-nav-link :href="route('setup.weekly-schedules.index')" :active="request()->routeIs('*setup.weekly-schedules*')">
                        {{ __('Horarios') }}
                    </x-nav-link>

                    <x-nav-link :href="route('comportamiento')" :active="request()->routeIs('comportamiento')">
                        {{ __('Comportamiento') }}
                    </x-nav-link>

                    <x-nav-link :href="route('setup.discounts.index')" :active="request()->routeIs('*setup.discounts*')">
                        {{ __('Descuentos') }}
                    </x-nav-link>

                    <x-nav-link :href="route('setup.deductions.index')" :active="request()->routeIs('*setup.deductions*')">
                        {{ __('Deducciones') }}
                    </x-nav-link>

                    <x-nav-link :href="route('setup.bonuses.index')" :active="request()->routeIs('*setup.bonuses*')">
                        {{ __('Asignaciones') }}
                    </x-nav-link>

                    <x-nav-link :href="route('setup.payrolls.index')" :active="request()->routeIs('*setup.payrolls*')">
                        {{ __('Nóminas') }}
                    </x-nav-link>

                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-wireui-dropdown>
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-wireui-dropdown.item label="Perfil de usuario" :href="route('profile.edit')" />
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-wireui-dropdown.item separator label="Salir" :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();" />
                    </form>
                </x-wireui-dropdown>
            </div>

            <!-- Responsive Hamburger Button -->
            <button @click="open = ! open"
                class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 sm:hidden">
                <svg x-show="!open" class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="open" class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('data-management')" :active="request()->routeIs('data-management')">
                {{ __('Personal') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('setup.weekly-schedules.index')" :active="request()->routeIs('*setup.weekly-schedules*')">
                {{ __('Horarios') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('comportamiento')" :active="request()->routeIs('comportamiento')">
                {{ __('Comportamiento') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('setup.discounts.index')" :active="request()->routeIs('*setup.discounts*')">
                {{ __('Descuentos') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('setup.deductions.index')" :active="request()->routeIs('*setup.deductions*')">
                {{ __('Deducciones') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('setup.bonuses.index')" :active="request()->routeIs('*setup.bonuses*')">
                {{ __('Asignaciones') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('setup.payrolls.index')" :active="request()->routeIs('*setup.payrolls*')">
                {{ __('Nóminas') }}
            </x-responsive-nav-link>

        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="text-base font-medium text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
