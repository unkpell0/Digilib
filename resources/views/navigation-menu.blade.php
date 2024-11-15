<nav x-data="{ open: false }" class="bg-sky-400 text-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-screen mx-auto px-4 sm:px-3 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex-none">
                <!-- Logo -->
                <div class="shrink-0 flex items-center ms-4">
                    <a href="{{ route('dashboard.index') }}">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="flex flex-1 justify-center space-x-4">
                <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Home') }}
                </x-nav-link>

                <x-nav-dropdown>{{ __('Genre') }}</x-nav-dropdown>
            </div>

            <div class="flex items-center space-x-4">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="relative">
                        <x-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <button
                                    class="flex items-center px-3 py-2 border border-transparent text-sm font-medium text-gray-500 bg-white rounded-md hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    {{ Auth::user()->currentTeam->name }}
                                    <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>
                                    <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-dropdown-link>
                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-dropdown-link>
                                    @endcan
                                    @if (Auth::user()->allTeams()->count() > 1)
                                        <div class="border-t border-gray-200"></div>
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Switch Teams') }}
                                        </div>
                                        @foreach (Auth::user()->allTeams() as $team)
                                            <x-switchable-team :team="$team" />
                                        @endforeach
                                    @endif
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endif

                {{-- di sebelah kanan --}}
                @auth
                    <x-nav-link>
                        <a href="#">
                            <i class="fa-solid fa-cart-shopping cursor-pointer text-xl hover:text-gray-600"></i></a>
                    </x-nav-link>
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center text-sm border-2 border-transparent rounded-full focus:outline-none">
                                <img class="h-8 w-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}"
                                    alt="{{ Auth::user()->name }}" />
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}"
                        class="hover:bg-red-500 login">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="hover:bg-cyan-400 -mr-2 ml-4 login">Register</a>
                    @endif
                @endauth

            </div>
        </div>
    </div>
</nav>
