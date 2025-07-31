<!-- NAVIGATION -->
<nav x-data="{ open: false }"
    class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 print:hidden">
    <div class="w-full mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left section -->
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/Metland.png') }}" alt="Logo" class="h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center">

                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('order.index')" :active="request()->routeIs('order.index')">
                        {{ __('Order') }}
                    </x-nav-link>

                    @if (Auth::user()->role_id === 1 || Auth::user()->role_id === 2)
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-white focus:outline-none transition">
                                    {{ __('Master Data') }}
                                    <svg class="ms-1 h-4 w-4 fill-current" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('department.index')">{{ __('Departmen') }}</x-dropdown-link>
                                <x-dropdown-link :href="route('category.index')">{{ __('Kategori') }}</x-dropdown-link>
                                <x-dropdown-link :href="route('item.index')">{{ __('Objek') }}</x-dropdown-link>
                            </x-slot>
                        </x-dropdown>

                        @if (Auth::user()->role_id === 1)
                            <x-dropdown align="left" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-white focus:outline-none transition">
                                        {{ __('Pengguna & Akses') }}
                                        <svg class="ms-1 h-4 w-4 fill-current" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('role.index')">{{ __('Role') }}</x-dropdown-link>
                                    <x-dropdown-link :href="route('user.index')">{{ __('User') }}</x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        @endif

                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-white focus:outline-none transition">
                                    {{ __('Status') }}
                                    <svg class="ms-1 h-4 w-4 fill-current" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('priority.index')">{{ __('Prioritas') }}</x-dropdown-link>
                                <x-dropdown-link :href="route('progress.index')">{{ __('Progress') }}</x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    @endif
                </div>
            </div>

            <!-- User Profile -->
            <div class="hidden sm:flex items-center ms-auto ps-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <svg class="ms-1 h-4 w-4 fill-current" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">{{ __('Profil') }}</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Keluar') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Mobile -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open"
                    class="p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- FULLSCREEN OVERLAY MENU -->
    <div x-show="open" @click.outside="open = false" x-transition
        class="fixed inset-0 z-50 bg-white dark:bg-gray-900 overflow-y-auto sm:hidden">
        <div class="p-6 space-y-6">
            <!-- Close button -->
            <div class="flex justify-end">
                <button @click="open = false"
                    class="text-gray-700 dark:text-gray-300 hover:text-red-600 text-2xl font-bold">
                    &times;
                </button>
            </div>

            <!-- Nav Links -->
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('order.index')" :active="request()->routeIs('order.index')">
                {{ __('Order') }}
            </x-responsive-nav-link>

            @if (Auth::user()->role_id === 1 || Auth::user()->role_id === 2)
                <!-- Master Data -->
                <div class="pt-4 border-t border-gray-300 dark:border-gray-700">
                    <div class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400 mb-2">Master Data</div>
                    <x-responsive-nav-link :href="route('department.index')"
                        :active="request()->routeIs('department.index')">{{ __('Departmen') }}</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('category.index')"
                        :active="request()->routeIs('category.index')">{{ __('Kategori') }}</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('item.index')"
                        :active="request()->routeIs('item.index')">{{ __('Objek') }}</x-responsive-nav-link>
                </div>

                <!-- Pengguna & Akses -->
                @if (Auth::user()->role_id === 1)
                    <div class="pt-4 border-t border-gray-300 dark:border-gray-700">
                        <div class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400 mb-2">Pengguna & Akses
                        </div>
                        <x-responsive-nav-link :href="route('role.index')"
                            :active="request()->routeIs('role.index')">{{ __('Role') }}</x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('user.index')"
                            :active="request()->routeIs('user.index')">{{ __('User') }}</x-responsive-nav-link>
                    </div>
                @endif

                <!-- Status -->
                <div class="pt-4 border-t border-gray-300 dark:border-gray-700">
                    <div class="text-xs font-semibold uppercase text-gray-500 dark:text-gray-400 mb-2">Status</div>
                    <x-responsive-nav-link :href="route('priority.index')"
                        :active="request()->routeIs('priority.index')">{{ __('Prioritas') }}</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('progress.index')"
                        :active="request()->routeIs('progress.index')">{{ __('Progress') }}</x-responsive-nav-link>
                </div>
            @endif

            <!-- Profile -->
            <div class="pt-4 border-t border-gray-300 dark:border-gray-700 space-y-1">
                <div class="text-sm text-gray-800 dark:text-white">{{ Auth::user()->name }}</div>
                <div class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</div>

                <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                    {{ __('Profil') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Keluar') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
