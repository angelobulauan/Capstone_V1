<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <!-- Use bg.jpg as the application logo -->
                        <img src="{{ asset('img/bg1.png') }}" alt="Logo" class="block h-9 w-10" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex items-center text-black dark:text-white">
                        <i class="fas fa-home" style="margin-right: 8px;"> {{_('Home')}}</i>
                    </x-nav-link>

                    <x-nav-link :href="route('user.article')" :active="request()->routeIs('Article')" class="flex items-center text-black dark:text-white">
                        <i class="fas fa-info"style="margin-right: 8px;"></i> {{-- FontAwesome icon --}}
                        {{ __('About') }}
                    </x-nav-link>

                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-4 py-2 text-base leading-5 font-medium rounded-md text-black dark:text-white hover:bg-blue-800 hover:text-white">
                                    <i class="fas fa-leaf" style="margin-right: 8px;"></i> <!-- Main icon -->
                                    {{ __('Sea Grasses') }}
                                    <i class="fas fa-caret-down" style="margin-left: 8px;"></i>
                                    <!-- Dropdown indicator -->
                                </button>

                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('user.view.index')" class="flex items-center text-black dark:text-white hover:bg-blue-800 hover:text-white">
                                    <i class="fas fa-eye"style="margin-right: 8px;"></i> <!-- Eye icon for "View All" -->
                                    {{ __('View All Sea Grasses') }}
                                </x-dropdown-link>

                                    <x-dropdown-link :href="route('user.addnew')" class="flex items-center text-black dark:text-white hover:bg-blue-800 hover:text-white">
                                        <i class="fas fa-plus" style="margin-right: 8px;"></i> <!-- Plus icon for "Add New" -->
                                        {{ __('Add New Sea Grass') }}
                                    </x-dropdown-link>

                                {{-- <x-dropdown-link :href="route('user.view.index')">
                                    <i class="fas fa-info-circle"></i> <!-- Info icon for "Status" -->
                                    {{ __('Status Uploaded') }}
                                </x-dropdown-link> --}}

                            </x-slot>
                        </x-dropdown>
                    </div>


                    <x-nav-link :href="route('user.map')" :active="request()->routeIs('seagrass.view')" class="flex items-center text-black dark:text-white">
                        <i class="fas fa-map-marked-alt"style="margin-right: 8px;"></i> {{-- FontAwesome icon --}}
                        {{ __('Maps') }}
                    </x-nav-link>


                    <x-nav-link :href="route('user.contact')" :active="request()->routeIs('home')" class="flex items-center text-black dark:text-white">
                        <i class="fas fa-envelope" style="margin-right: 8px;"></i> {{-- FontAwesome icon with space --}}
                        {{ __('Contact Us') }}
                    </x-nav-link>

                    @php
                                    // Get messages and their corresponding IDs
                                    $messages = DB::table('request_notifs')
                                        ->where('u_id', Auth::id())
                                        ->where('archive', 0) // Only fetch non-archived messages
                                        ->get(); // Get all columns, including ID
                                @endphp
                    <div class="relative" style="float:right;padding-left: 50px; padding-top: 20px">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <i class="fas fa-bell" style="font-size: 1.5rem; cursor: pointer;"></i>
                                <span class="badge rounded-pill bg-danger text-white">{{ $messages->count() }}</span>
                            </x-slot>
                            <x-slot name="content">
                                <!-- Fetch messages from the request_notif table -->

                                <!-- Display the messages -->
                                @if ($messages->isNotEmpty())
                                    @foreach ($messages as $message)
                                        <div
                                            class="notification-box px-4 py-2 flex justify-between items-center mb-2 border">
                                            <p class="text-gray-800">{{ $message->message }} - {{ $message->updated_by }}</p>
                                            <button class="text-red-500 ml-2 hover:text-red-700"
                                                onclick="archiveMessage({{ $message->id }})" type="button"
                                                title="Archive this message">
                                                <i class="fas fa-times"></i> <!-- Using 'X' icon -->
                                            </button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="px-4 py-2">
                                        <p>You Have No Notifications!</p>
                                    </div>
                                @endif
                            </x-slot>
                        </x-dropdown>

                        <script>
                            function archiveMessage(id) {
                                // Send a request to archive the message
                                fetch(`/request/request/${id}/archive`, {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}', // Add CSRF token for security
                                            'Content-Type': 'application/json',
                                        },
                                        body: JSON.stringify({
                                            archive: 1
                                        }) // Data to send
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            // Optionally, you can refresh the dropdown or remove the message from the UI
                                            location.reload(); // Reloads the page to see updated messages
                                        } else {
                                            alert('Failed to archive the message.'); // Handle errors
                                        }
                                    });
                            }
                        </script>
                    </div>

                    <style>
                        .notification-box {
                            background-color: white;
                            padding: 10px;
                        }
                    </style>


                </div>
            </div>



            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-black dark:text-black bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
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
                        <x-dropdown-link :href="route('profile.edit')" class="text-black dark:text-black hover:no-underline">
                            <i class="fas fa-user"></i> {{ __('Profile') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('request.requests.index')" class="text-black dark:text-black hover:no-underline">
                            <i class="fas fa-bell"></i> {{ __('Requests') }}
                            ({{ DB::table('seaviews')->where('u_id', auth()->user()->id)->where('status', 'pending')->count() }})
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('user.user.help')" class="text-black dark:text-black no-underline">
                            <i class="fas fa-question-circle"></i> {{ __('Help') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
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
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
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

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">

        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button
                    class="flex items-center px-4 py-2 text-sm font-medium leading-5 text-gray-700 dark:text-gray-300 transition duration-150 ease-in-out hover:text-gray-500 dark:hover:text-gray-400 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300">
                    Notifications
                    <span class="badge rounded-pill bg-danger text-white ml-2">{{ $messages->count() }}</span>
                </button>
            </x-slot>
            <x-slot name="content">
                @if ($messages->isNotEmpty())
                    @foreach ($messages as $message)
                        <div class="notification-box px-4 py-2 flex justify-between items-center mb-2 border">
                            <p class="text-gray-800">{{ $message->message }} - {{ $message->updated_by }}</p>
                            <button class="text-red-500 ml-2 hover:text-red-700"
                                onclick="archiveMessage({{ $message->id }})" type="button"
                                title="Archive this message">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endforeach
                @else
                    <div class="px-4 py-2">
                        <p>You Have No Notifications!</p>
                    </div>
                @endif
            </x-slot>
        </x-dropdown>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex items-center">
                <i class="fas fa-home" style="margin-right: 8px;"></i> <!-- Home icon -->
                {{ __('Home') }}
            </x-responsive-nav-link>


            <x-responsive-nav-link :href="route('user.article')" :active="request()->routeIs('Article')" class="flex items-center no-underline">
                <i class="fas fa-newspaper" style="margin-right: 8px;"></i> <!-- Article icon -->
                {{ __('Article') }}
            </x-responsive-nav-link>


            <x-responsive-nav-link :href="route('user.view.index')" :active="request()->routeIs('Sea Grasses')">
                <i class="fas fa-leaf"></i> {{ __('Sea Grasses') }}
            </x-responsive-nav-link>


               <x-responsive-nav-link :href="route('user.addnew')" >
                <i class="fas fa-plus"></i> <!-- Plus icon for "Add New" -->
                {{ __('Add New Sea Grass') }}
            </x-responsive-nav-link>


            <x-responsive-nav-link :href="route('user.map')" :active="request()->routeIs('Maps')">
                <i class="fas fa-map"></i> {{ __('Maps') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('user.contact')" :active="request()->routeIs('Contact Us')">
                <i class="fas fa-envelope"></i> {{ __('Contact Us') }}
            </x-responsive-nav-link>

        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    <i class="fas fa-user"></i> {{ __('Profile') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('request.requests.index')">
                    <i class="fas fa-bell"></i> {{ __('Requests') }}
                            ({{ DB::table('seaviews')->where('u_id', auth()->user()->id)->where('status', 'pending')->count() }})
                </x-responsive-nav-link>

                <x-dropdown-link :href="route('user.user.help')" class="text-black dark:text-black no-underline">
                    <i class="fas fa-user"></i> {{ __('Help') }}
                </x-dropdown-link>


                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt"></i> {{ __('Log Out') }}
                    </x-responsive-nav-link>

                </form>
            </div>
        </div>
    </div>
</nav>

