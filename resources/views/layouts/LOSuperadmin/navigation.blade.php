<nav x-data="{ open: false }" class="bg-white/30 backdrop-blur-md border-b border-gray-200 dark:bg-gray-800/30 dark:border-gray-700 shadow-lg">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" style="text-decoration: none;">
                        <!-- Use bg.jpg as the application logo -->
                        <img src="{{ asset('img/bg1.png') }}" alt="Logo" class="block h-9 w-10" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <!-- Dashboard Link -->
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="flex items-center text-black dark:text-white hover:no-underline">
                        <i class="fas fa-home" style="margin-right: 8px;"></i> <!-- Home Icon -->
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <!-- Users Link -->
                    <x-nav-link :href="route('superadmin.view')" :active="request()->is('superadmin.view')"
                        class="flex items-center text-black dark:text-white hover:no-underline">
                        <i class="fas fa-users" style="margin-right: 8px;"></i>
                        {{ __('Users') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:absolute sm:right-0" style="float: right; top: 15px; margin-right: 100px">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-black dark:text-white bg-white/30 dark:bg-gray-800/30 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" class="text-black dark:text-white hover:no-underline"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="fas fa-sign-out-alt"></i> {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <!-- Dashboard Link -->
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex items-center">
                    <i class="fas fa-home" style="margin-right: 8px;"></i> <!-- Home Icon -->
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>

                <!-- Users Link -->
                <x-responsive-nav-link :href="route('superadmin.view')" :active="request()->is('superadmin.view')" class="flex items-center">
                    <i class="fas fa-users" style="margin-right: 8px;"></i> <!-- Users Icon -->
                    {{ __('Users') }}
                </x-responsive-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <!-- Profile Link -->
                    <x-responsive-nav-link :href="route('profile.edit')" class="hover:no-underline">
                        <i class="fas fa-user"></i> {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();" class="hover:no-underline">
                            <i class="fas fa-sign-out-alt"></i> {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
